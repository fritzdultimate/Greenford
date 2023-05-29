<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSavingsGoalRequest;
use App\Http\Requests\CreateSavingsRequest;
use App\Http\Requests\LockFundRequest;
use App\Http\Requests\SendMoneyRequest;
use App\Http\Requests\StoreDepositRequest;
use App\Models\AdminWallet;
use App\Models\ChildInvestmentPlan;
use App\Models\Deposit;
use App\Models\LockedFunds;
use App\Models\MainWallet;
use App\Models\ReferrersInterestRelationship;
use App\Models\Savings;
use App\Models\SavingsLogs;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserAccountData;
use App\Models\UserSettings;
use App\Models\UserWallet;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class DepositController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendMoneyRequest $request, Transactions $transaction) {

        $validated = $request->validated();
        $user_settings = UserSettings::where('user_id', Auth::id())->first();

        $kyc_1_limit = returnCurrencyLocale($user_settings->currency, 1000);
        $kyc_2_limit = returnCurrencyLocale($user_settings->currency, 5000);


        if(strlen((string) $request->account_number) < 5) {
            return response()->json(
                [
                    'errors' => ['message' => ['Invalid account number!']]
                ], 401
            );
        }

        $user = Auth::user();
        $sender = UserAccountData::where('user_id', $user->id)->first();
        $beneficiary = UserAccountData::where('account_number', $request->account_number)->first();
        //    $hash = generateTransactionHash($deposit, 'transaction_hash', 25);

        if(!Schema::hasColumn('user_settings', 'pin')) {
            Schema::table('user_settings', function(Blueprint $table) {
                $table->string('pin');
            });
        }

        $pin = UserSettings::where('user_id', $user->id)->first()['pin'];
        if(!$pin || $pin == 1111) {
            return response()->json(
                [
                    'errors' => ['message' => ['Please setup your transaction pin!']]
                ], 401
            );
        }

        if($pin !== $request->pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Wrong pin!']]
                ], 401
            );
        }

       if($sender->account_balance < $request->amount) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient funds for this transaction!']]
                ], 401
            );
       } 
    //    elseif(!$beneficiary) {
    //         return response()->json(
    //             [
    //                 'errors' => ['message' => ['Invalid beneficiary account number!']]
    //             ], 401
    //         );
    //    } 
       elseif($beneficiary && $beneficiary->account_number == $sender->account_number) {
            return response()->json(
                [
                    'errors' => ['message' => ['Transferring money to yourself is not allowed!']]
                ], 401
            );
       } elseif($request->amount > 1000 && $sender->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ["You can only transfer money not greater $kyc_1_limit at once, upgrade your account to transfer more!"]]
                ], 401
            );
       } elseif($request->amount > 5000 && $sender->kyc_level == 'tier 2') {
            return response()->json(
                [
                    'errors' => ['message' => ["You can only transfer money not greater $kyc_2_limit at once, upgrade your account to transfer more!"]]
                ], 401
            );
        } elseif ($beneficiary && $request->amount > 1000 && $beneficiary->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ["Beneficiary can only receive amount not greater than $kyc_1_limit at a go, split and send!"]]
                ], 401
            );
        } elseif ($beneficiary && $request->amount > 10000 && $beneficiary->kyc_level == 'tier 2') {
            return response()->json(
                [
                    'errors' => ['message' => ["Beneficiary can only receive amount not greater than $kyc_2_limit at a go, split and send!"]]
                ], 401
            );
        } 
        elseif (($sender->total_sent_out == 100000 || $request->amount + $sender->total_sent_out > 100000) && $sender->kyc_level !== 'tier 3') {
            return response()->json(
                [
                    'errors' => ['message' => ['Daily transaction limit exeeded, upgrade to tier 3 for higher limit!']]
                ], 401
            );
        }

        elseif (($sender->total_sent_out == 10000 || $request->amount + $sender->total_sent_out > 10000) && $sender->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['Daily transaction limit exeeded, upgrade your account for higher limit!']]
                ], 401
            );
        }

        elseif ($beneficiary && ($beneficiary->total_received == 100000 || $request->amount + $beneficiary->total_received > 100000) && $beneficiary->kyc_level !== 'tier 3') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary has exeeded their daily receiving limit!']]
                ], 401
            );
        }

        elseif ($beneficiary && ($beneficiary->total_received == 10000 || $request->amount + $beneficiary->total_received > 10000) && $beneficiary->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary has exeeded their daily receiving limit!']]
                ], 401
            );
        } elseif($sender->user->suspended) {
            return response()->json(
                [
                    'errors' => ['message' => ['Action denied!, you cannot perform this action in your location!']]
                ], 401
            );
        }
        $charges = $request->amount > 500 ? 1 : 0.5;
        $total_amount_to_debit = $request->amount + $charges;
        $debit_sender = $sender->decrement('account_balance', $total_amount_to_debit);
        $transaction_id = generateTransactionHash($transaction, 'transaction_id', 11);

        if($debit_sender) {
            // $sender->decrement('total_balance', $total_amount_to_debit);
            $sender->increment('total_outgoing', $request->amount);
            $sender->increment('total_sent_out', $request->amount);

            // notify sender
            $receiver = $beneficiary ? $beneficiary->user->fullname : $request->account_number;
            notify("You sent $ $request->amount to $receiver", 'money sent', $sender->user_id, true, 'debit');

            // send alert to sender
            $details = [
                'subject' => 'Transaction Notification [Debit Alert]',
                'beneficiary' => $beneficiary ? $beneficiary->user->fullname : $request->account_number,
                'beneficiary_account_number' => $beneficiary ? $beneficiary->account_number : $request->account_number,
                'amount' => number_format($request->amount, 2), 
                'balance' => number_format($sender->account_balance, 2),
                'transaction_id' => $transaction_id,
                'date' => get_day_format(date("Y-m-d H:i:s")),
                'sign' => '-',
                'color' => 'red',
                'view' => 'emails.user.transfersenderemail',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($sender->user->email)->send($mailer);

            if($beneficiary) {
                $credit_beneficiary = $beneficiary->increment('account_balance', $request->amount);

                if($credit_beneficiary) {
                    // $beneficiary->increment('total_balance', $request->amount);
                    $beneficiary->increment('total_incoming', $request->amount);
                    $beneficiary->increment('total_received', $request->amount);

                    // notify sender
                    $sender_notif = $sender->user->fullname;
                    notify("You received $ $request->amount from $sender_notif", 'payment received', $beneficiary->user_id, true, 'credit');

                    // send alert to beneficiary
                    $details = [
                        'subject' => 'Transaction Notification [Credit Alert]',
                        'sender' => $sender->user->fullname,
                        'sender_account_number' => $sender->account_number,
                        'amount' => number_format($request->amount, 2),
                        'balance' => number_format($beneficiary->account_balance,2),
                        'transaction_id' => $transaction_id,
                        'date' => get_day_format(date("Y-m-d H:i:s")),
                        'sign' => '+',
                        'color' => 'green',
                        'view' => 'emails.user.transferreceiveremail',
                    ];
        
                    $mailer = new \App\Mail\MailSender($details);
                    Mail::to($beneficiary->user->email)->send($mailer);
                } else {
                    return response()->json(
                        [
                            'errors' => ['message' => ['Could not process transaction, please contact us immediately if you were debited!']]
                        ], 401
                    );
                }
            }
        } else {
            return response()->json(
                [
                    'errors' => ['message' => ['Something went wrong, please contact support!']]
                ], 401
            );
        }

       
       $sender_balance = UserAccountData::where('user_id', $user->id)->first()['account_balance'];
       $beneficiary_balance = $beneficiary ? UserAccountData::where('account_number', $request->account_number)->first()['account_balance'] : $request->amount;
       $transaction = [
           'user_id' => $sender->user->id,
           'beneficiary_id' => $beneficiary ? $beneficiary->user->id : $sender->user->id,
           'amount' => $request->amount,
           'transaction_id' => $transaction_id,
           'description' => $request->description,
           'type' => 'credit',
           'account_number' => $request->account_number,
           'transaction' => 'transfer',
           'sender_balance' => $sender_balance,
           'beneficiary_balance' => $beneficiary_balance,
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
           'sender_name' => $sender->user->fullname,
           'beneficiary_name' => $beneficiary ? $beneficiary->user->fullname : $sender->user->fullname
       ];

        $create_transaction = Transactions::insert($transaction);

        if($create_transaction) {
            return response()->json(
                [
                    'success' => ['message' => ['Money sent.']]
                ], 200
            );
        }
        
    }

    public function createSavingsGoal(CreateSavingsGoalRequest $createSavingsGoalRequest, Savings $savings) {
        $validated = $createSavingsGoalRequest->validated();
        $user = Auth::user();
        $savings_id = generateTransactionHash($savings, 'savings_id', 11);

        $savings = Savings::where('user_id', $user->id)->get();

        if($savings->count() === 20) {
            return response()->json(
                [
                    'errors' => ['message' => ['You cannot have more than 25 consecutively active savings goal running!']]
                ], 401
            );
        }

        $create = Savings::create([
            'user_id' => $user->id,
            'target' => $validated['target'],
            'name' => $validated['name'],
            'description' => $createSavingsGoalRequest->description,
            'savings_id' =>$savings_id,
            'saved' => 0.00
        ]);

        if($create) {
            // notify sender
            $save_name = $validated['name'];
            notify("You created $save_name Savings ", 'Savings Goal Created', $user->id, true, 'credit');
            // send email.

            $details = [
                'subject' => 'Savings goal created',
                'goal_name' => $validated['name'],
                'description' => $createSavingsGoalRequest->description,
                'target' => $validated['target'], 
                'savings_id' => $savings_id,
                'date' => get_day_format(date("Y-m-d H:i:s")),
                'sign' => '-',
                'color' => 'red',
                'view' => 'emails.user.savingscreated',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);

            

            return response()->json(
                [
                    'success' => ['message' => ['Goal created, you can start saving money!']]
                ], 201
            );
        }
    } 


    public function getSavings(Savings $savings) {
        $savings = $savings->where('user_id', Auth::id())->get();

        if($savings->count() == 0) {
            return response()->json(
                [
                    'errors' => ['message' => ['You have not created any savings goal.']]
                ], 401
            );
        } else {
            return response()->json(
                [
                    'success' => ['message' => [$savings]]
                ], 200
            );
        }
    }

    public function createSavings(CreateSavingsRequest $createSavingsRequest, SavingsLogs $savingsLogs) {
        $validated = $createSavingsRequest->validated();

        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();

        if(!Schema::hasColumn('user_settings', 'pin')) {
            Schema::table('user_settings', function(Blueprint $table) {
                $table->string('pin');
            });
        }

        $pin = UserSettings::where('user_id', $user->id)->first()['pin'];
        if(!$pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Please setup your transaction pin!']]
                ], 401
            );
        }

        if($pin !== $createSavingsRequest->pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Wrong pin!']]
                ], 401
            );
        }

        if($validated['amount'] > $user_account->account_balance) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient fund.']]
                ], 401
            );
        }

        $goal = Savings::where('id', $createSavingsRequest->savings)->first();

        if($goal->target == $goal->saved) {
            return response()->json(
                [
                    'errors' => ['message' => ['Goal fulfilled.']]
                ], 401
            );
        }

        if($goal->target < $goal->saved + $validated['amount']) {
            return response()->json(
                [
                    'errors' => ['message' => ['Exeeded target.']]
                ], 401
            );
        }

        $user_account->decrement('account_balance', $validated['amount']);
        $goal->increment('saved', $validated['amount']);

        $transaction_id = generateTransactionHash($savingsLogs, 'transaction_id', 11);

        $logSavings = SavingsLogs::create([
            'amount' => $validated['amount'],
            'savings_id' => $createSavingsRequest->savings,
            'transaction_id' => $transaction_id
        ]);

        if($logSavings) {
            $goal->refresh();

            // notify saver
            notify("You saved $ $createSavingsRequest->amount to  $goal->name savings goal", 'Money Saved', $goal->user_id, true, 'credit');
            // send email.

            $details = [
                'subject' => 'You Save Some Money',
                'goal_name' => $goal->name,
                'amount' => $validated['amount'],
                'description' => $goal->description,
                'target' => $goal->target, 
                'savings_id' => $goal->savings_id,
                'date' => get_day_format(date("Y-m-d H:i:s")),
                'sign' => '-',
                'color' => 'red',
                'view' => 'emails.user.moneysaved',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);
            return response()->json(
                [
                    'success' => ['message' => [$goal->saved == $goal->target ? "Congrats! You have successfully reach your target of $$goal->target savings" : 'Money saved, great.']]
                ], 201
            );
        }
    }

    public function lockFund(LockFundRequest $lockFundRequest, LockedFunds $lockedFunds) {
        $validated = $lockFundRequest->validated();

        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();

        if(!Schema::hasColumn('user_settings', 'pin')) {
            Schema::table('user_settings', function(Blueprint $table) {
                $table->string('pin');
            });
        }

        $pin = UserSettings::where('user_id', $user->id)->first()['pin'];
        if(!$pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Please setup your transaction pin!']]
                ], 401
            );
        }

        if($pin !== $lockFundRequest->pin) {
            return response()->json(
                [
                    'errors' => ['message' => ['Wrong pin!']]
                ], 401
            );
        }

        if($validated['amount'] > $user_account->account_balance) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient fund.']]
                ], 401
            );
        }

        $user_account->decrement('account_balance', $validated['amount']);
        $transaction_id = generateTransactionHash($lockedFunds, 'transaction_id', 11);
        $due_date = addDaysToDate(date("Y-m-d H:i:s"), $validated['duration']);
        $lock_fund = LockedFunds::create([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'transaction_id' => $transaction_id,
            'due_date' => $due_date
        ]);

        if($lock_fund) {

            // notify locker
            notify("You locked £ $lockFundRequest->amount till " . get_day_name($due_date), 'Money Locked', $user->id, true, 'debit');

            // send email
            $details = [
                'subject' => 'You Locked Some Money',
                'amount' => $validated['amount'],
                'transaction_id' => $transaction_id,
                'due_date' => get_day_format($due_date),
                'date' => get_day_format(date("Y-m-d H:i:s")),
                'sign' => '-',
                'color' => 'red',
                'view' => 'emails.user.lockmoney',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);
            return response()->json(
                [
                    'success' => ['message' => ['Fund locked successfully']]
                ], 201
            );
        }
    }

    public function clearTotalReceivedAndTotalSentOut() {
        isNoon();
    }

    public function unlockFunds() {
        unlockFunds();
    }

}
