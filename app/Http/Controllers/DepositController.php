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
use App\Models\UserWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SendMoneyRequest $request, Transactions $transaction) {

        $validated = $request->validated();

        $user = Auth::user();
        $sender = UserAccountData::where('user_id', $user->id)->first();
        $beneficiary = UserAccountData::where('account_number', $request->account_number)->first();
        //    $hash = generateTransactionHash($deposit, 'transaction_hash', 25);

       if($sender->account_balance < $request->amount) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient funds for this transaction!']]
                ], 401
            );
       } elseif(!$beneficiary) {
            return response()->json(
                [
                    'errors' => ['message' => ['Invalid beneficiary account number!']]
                ], 401
            );
       } elseif($beneficiary->account_number == $sender->account_number) {
            return response()->json(
                [
                    'errors' => ['message' => ['Transferring money to yourself is not allowed!']]
                ], 401
            );
       } elseif($request->amount > 1000 && $sender->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['You can only transfer money not greater $1,000, upgrade your account to transfer more!']]
                ], 401
            );
       } elseif($request->amount > 10000 && $sender->kyc_level == 'tier 2') {
            return response()->json(
                [
                    'errors' => ['message' => ['You can only transfer money not greater $10,000, upgrade your account to transfer more!']]
                ], 401
            );
        } elseif ($request->amount > 1000 && $beneficiary->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary can only receive amount not greater than $1,000 at a go!']]
                ], 401
            );
        } elseif ($request->amount > 10000 && $beneficiary->kyc_level == 'tier 2') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary can only receive amount not greater than $10,000 at a go!']]
                ], 401
            );
        } 
        elseif (($sender->total_sent_out > 100000 || $request->amount + $sender->total_sent_out > 100000) && $sender->kyc_level !== 'tier 3') {
            return response()->json(
                [
                    'errors' => ['message' => ['Daily transaction limit exeeded, upgrade to tier 3 for higher limit!']]
                ], 401
            );
        }

        elseif (($sender->total_sent_out > 10000 || $request->amount + $sender->total_sent_out > 10000) && $sender->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['Daily transaction limit exeeded, upgrade to tier 2 for higher limit!']]
                ], 401
            );
        }

        elseif (($beneficiary->total_received > 100000 || $request->amount + $beneficiary->total_received > 100000) && $beneficiary->kyc_level !== 'tier 3') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary has exeeded their receiving limit!']]
                ], 401
            );
        }

        elseif (($beneficiary->total_received > 10000 || $request->amount + $beneficiary->total_received > 10000) && $beneficiary->kyc_level == 'tier 1') {
            return response()->json(
                [
                    'errors' => ['message' => ['Beneficiary has exeeded their receiving limit!']]
                ], 401
            );
        }
        $charges = $request->amount > 500 ? 1 : 0.5;
        $total_amount_to_debit = $request->amount + $charges;
        $debit_sender = $sender->decrement('account_balance', $total_amount_to_debit);

        if($debit_sender) {
            $sender->decrement('total_balance', $total_amount_to_debit);
            $sender->increment('total_outgoing', $request->amount);
            $sender->increment('total_sent_out', $request->amount);

            // notify sender
            $receiver = $beneficiary->user->fullname;
            notify("You sent $ $request->amount to $receiver", 'money sent', $sender->user_id, true, 'debit');

            // send alert to sender


            $credit_beneficiary = $beneficiary->increment('account_balance', $request->amount);

            if($credit_beneficiary) {
                $beneficiary->increment('total_balance', $request->amount);
                $beneficiary->increment('total_incoming', $request->amount);
                $beneficiary->increment('total_received', $request->amount);

                // notify sender
                $sender_notif = $sender->user->fullname;
                notify("You received $ $request->amount from $sender_notif", 'payment received', $beneficiary->user_id, true, 'credit');

                // send alert to beneficiary
            } else {
                return response()->json(
                    [
                        'errors' => ['message' => ['Could not process transaction, please contact us immediately if you were debited!']]
                    ], 401
                );
            }
        } else {
            return response()->json(
                [
                    'errors' => ['message' => ['Something went wrong, please contact support!']]
                ], 401
            );
        }

       $transaction_id = generateTransactionHash($transaction, 'transaction_id', 11);
       $sender_balance = UserAccountData::where('user_id', $user->id)->first()['account_balance'];
       $beneficiary_balance = UserAccountData::where('account_number', $request->account_number)->first()['account_balance'];
       $transaction = [
           'user_id' => $sender->user->id,
           'beneficiary_id' => $beneficiary->user->id,
           'amount' => $request->amount,
           'transaction_id' => $transaction_id,
           'description' => $request->description,
           'type' => 'credit',
           'account_number' => $request->account_number,
           'transaction' => 'transfer',
           'sender_balance' => $sender_balance,
           'beneficiary_balance' => $beneficiary_balance,
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s')
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

        if($savings->count() === 5) {
            return response()->json(
                [
                    'errors' => ['message' => ['You cannot have more than 5 consecutively active savings goal running!']]
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
            // send email.

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

            // send email
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

            // send email
            return response()->json(
                [
                    'success' => ['message' => ['Fund locked successfully']]
                ], 201
            );
        }
    }

}
