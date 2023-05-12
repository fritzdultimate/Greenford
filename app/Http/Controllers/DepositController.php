<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMoneyRequest;
use App\Http\Requests\StoreDepositRequest;
use App\Models\AdminWallet;
use App\Models\ChildInvestmentPlan;
use App\Models\Deposit;
use App\Models\MainWallet;
use App\Models\ReferrersInterestRelationship;
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
    public function store(SendMoneyRequest $request, Deposit $deposit) {

        $validated = $request->validated();

        $user = Auth::user();
        $user_account = UserAccountData::where('user_id', $user->id)->first();
    //    $hash = generateTransactionHash($deposit, 'transaction_hash', 25);

       if($request) {
            return response()->json(
                [
                    'errors' => ['message' => [$user_account->total_balance]]
                ], 401
            );
       }

       if(!$plan_name_is_valid) {
            return response()->json(
                [
                    'errors' => ['message' => ['Unknown investment plan has been submitted and failed']]
                ], 401
            );
       }

       $plan_models = ChildInvestmentPlan::where('id', $validated['child_plan_id'])->first();

        //validate submited data, to match exactly what is expected...
       if($plan_models->minimum_amount > $validated['amount'] || $plan_models->maximum_amount < $validated['amount']) {
            return response()->json(
                [
                    'errors' => ['message' => ['Amount out of range of the selected plan']]
                ], 401
            );
       }

       $user_id = Auth::id();

       $data = [
           'user_id' => $user_id,
           'child_investment_plan_id' => $plan_models->id,
           'transaction_hash' => $hash,
           'user_wallet_id' => $validated['user_wallet_id'],
           'amount' => $validated['amount'],
           'remaining_duration' => $plan_models->duration,
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s')
       ];

        $create_deposit = $deposit->insert($data);

        if($create_deposit) {
            ChildInvestmentPlan::where('id', $plan_models->id)->increment('total_deposited', $validated['amount']);
            $user_wallet = UserWallet::find($validated['user_wallet_id']);
            $wallet = MainWallet::find($user_wallet['main_wallet_id']);
            Transactions::insert([
                'amount' => $validated['amount'],
                'user_id' => $user_id,
                'currency' => $wallet->currency,
                'transaction_hash' => $hash,
                'type' => 'deposit',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $request_type = ucFirst($request->type);
            // send email
            $user = User::find($user_id);

            $details = [
                'subject' => 'New Deposit Request Created Successfully',
                'username' => $user->name,
                'amount' => $validated['amount'], 
                'transaction_hash' => $hash,
                'wallet' => $wallet->currency,
                'plan' => $plan_name_is_valid->name,
                'duration' => $plan_name_is_valid->duration,
                'wallet_address' => $wallet->currency_address,
                'date' => date("Y-m-d H:i:s"),
                'view' => 'emails.user.depositrequest',
                'email' => $user->email
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);

            $admins = User::where(['is_admin' => 1, 'permission' => '1'])->get();
            $details['view'] = 'emails.admin.depositrequest';
            $details['subject'] = 'A client has recently created a new deposit request on '. env('SITE_NAME');

            // send to admins
            foreach($admins as $admin) {
                $mailer = new \App\Mail\MailSender($details);
                Mail::to($admin->email)->send($mailer);
            }

            return response()->json(
                [
                    'success' => ['message' => ['Deposit request was successfully created'], 'wallet' => $wallet_id_is_valid->admin_wallet]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Something is not right, our team is working towards restoring the service asap! If this persist, please contact our support.']]
            ], 401
        );
        
    }

    public function reinvest(StoreDepositRequest $request, Deposit $deposit) {
        $validated = $request->validated();
        $user_id = Auth::id();
        $user = User::find($user_id);
        
        $hash = generateTransactionHash($deposit, 'transaction_hash', 25);

        $user_wallet_model = UserWallet::where('id', $request->user_wallet_id)->first();
        
        if(!$user_wallet_model) {

            return response()->json(
                [
                    'errors' => ['message' => ['Unknown Wallet provided for this transaction']]
                ], 401
            );
        }

        if($user->deposit_balance < $validated['amount']) {
            return response()->json(
                [
                    'errors' => ['message' => ['Investment amount less than deposit balance']]
                ], 401
            );
        }

        $plan_details = ChildInvestmentPlan::where('id', $validated['child_plan_id'])->first();

       if(!$plan_details) {
            return response()->json(
                [
                    'errors' => ['message' => ['Invalid plan seleted']]
                ], 401
            );
       }

        //validate submited data, to match exactly what is expected...
       if($plan_details->minimum_amount > $validated['amount'] || $plan_details->maximum_amount < $validated['amount']) {
            return response()->json(
                [
                    'errors' => ['message' => ['Amount out of range of the selected plan']]
                ], 401
            );
       }

       $user_id = Auth::id();

        $data = [
            'user_id' => Auth::id(),
            'child_investment_plan_id' => $plan_details->id,
            'transaction_hash' => $hash,
            'user_wallet_id' => $validated['user_wallet_id'],
            'amount' => $validated['amount'],
            'remaining_duration' => $plan_details->duration,
            'reinvestment' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insert_data = $deposit->insert($data);

        if($insert_data) {
            ChildInvestmentPlan::where('id', $plan_details->id)->increment('total_deposited', $validated['amount']);
            $wallet = UserWallet::find($validated['user_wallet_id']);
            Transactions::insert([
                'amount' => $validated['amount'],
                'user_id' => $user_id,
                'currency' => $wallet->admin_wallet->currency,
                'transaction_hash' => $hash,
                'type' => 'reinvestment',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // send email
            $user = User::find($user_id);
            $details = [
                'subject' => 'New Reinvestment Request Created Successfully',
                'username' => $user->name,
                'amount' => $validated['amount'], 
                'transaction_hash' => $hash,
                'wallet' => $wallet->currency,
                'plan' => $plan_details->name,
                'duration' => $plan_details->duration,
                'wallet_address' => $wallet->currency_address,
                'date' => date("Y-m-d H:i:s"),
                'view' => 'emails.user.reinvestmentrequest',
                'email' => $user->email
            ];

            $admins = User::where(['is_admin' => 1, 'permission' => '1'])->get();

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);
            $details['view'] = 'emails.admin.reinvestmentrequest';

            // send to admins
            foreach($admins as $admin) {
                $mailer = new \App\Mail\MailSender($details);
                Mail::to($admin->email)->send($mailer);
            }

            return response()->json(
                [
                    'success' => ['message' => ['Reinvestment created successfully'], 'wallet' => $user_wallet_model->admin_wallet]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Something is not right, please try again']]
            ], 401
        );
    }

    public function approve(Request $request, Deposit $deposit) {
        // authenticate admin

        // approve deposit
        $deposit_id = $request->id;
        $is_valid_deposit = $deposit->where('id', $deposit_id)->first();

        if(!$is_valid_deposit) {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit request not found']]
                ], 404
            );
        }

        if($is_valid_deposit->status == 'accepted') {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit already approved']]
                ], 208
            );
        }

        $approved_deposit = $deposit->where('id', $deposit_id)->update(
            [
                'status' => 'accepted',
                'expires_at' => addDaysToDate(date("Y-m-d H:i:s"), $is_valid_deposit->remaining_duration),
                'running' => 1,
                'approved_at' => date("Y-m-d H:i:s")
            ]);
        

        if($approved_deposit) {
            $user_has_invested = User::where('id', $is_valid_deposit->user_id)->select(['invested'])->first();
            if(!$user_has_invested->invested) {
                User::where('id', $is_valid_deposit->user_id)->update([
                    'invested' => 1
                ]);
            }
            $referrer = $is_valid_deposit->user->referrer;
            if($referrer) {
                $referrer_data = User::where('name', $referrer)->first();
                $interest_receiver_id = $referrer_data->id;
                $depositor_id = $is_valid_deposit->user_id;
                $deposit_id = $is_valid_deposit->id;

                $record_exist_in_referrers_interest_relationship_table = ReferrersInterestRelationship::where([
                    'interest_receiver_id' => $interest_receiver_id,
                    'depositor_id' => $depositor_id
                ])->first();

                if(!$record_exist_in_referrers_interest_relationship_table) {
                    $referrer_interest_rate = $is_valid_deposit->plan->referral_bonus;
                    $referrer_bonus = ($is_valid_deposit->amount/100) * $referrer_interest_rate;

                    $credit_referrer_bonus = User::where('id', $interest_receiver_id)->increment('referral_bonus', $referrer_bonus);

                    if($credit_referrer_bonus) {
                        $insert_into_referrers_interest_relationshipt_table = ReferrersInterestRelationship::insert([
                            'interest_receiver_id' => $interest_receiver_id,
                            'depositor_id' => $depositor_id,
                            'deposit_id' => $is_valid_deposit->id,
                            'amount' => $referrer_bonus,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

                        if($insert_into_referrers_interest_relationshipt_table) {
                            // send mail to referrer
                            $details = [
                                'subject' => 'You Received A Referral Bonus',
                                'username' => $is_valid_deposit->user->name,
                                'amount_deposited' => $is_valid_deposit->amount,
                                'bonus' => $referrer_bonus,
                                'date' => date("Y-m-d H:i:s"),
                                'view' => 'emails.user.referralbonus',
                                'email' => $referrer_data->email
                            ];
            
                            $mailer = new \App\Mail\MailSender($details);
                            Mail::to($referrer_data->email)->send($mailer);
                        }
                    }
                }
            }
            ChildInvestmentPlan::where('id', $is_valid_deposit->child_investment_plan_id)->increment('total_accepted', $is_valid_deposit->amount);
            // send email
            $user = User::find($is_valid_deposit->user_id);

            $details = [
                'subject' => 'Your Deposit Has Been Approved',
                'amount' => $is_valid_deposit->amount,
                'username' => $is_valid_deposit->user->name,
                'transaction_hash' => $is_valid_deposit->transaction_hash,
                'wallet' => $is_valid_deposit->user_wallet->currency,
                'duration' => $is_valid_deposit->plan->duration,
                'plan' => $is_valid_deposit->plan->name,
                'date' => date("Y-m-d H:i:s"),
                'view' => 'emails.user.depositapproved',
                'email' => $user->email
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);

            // update wallet transaction count
            $main_wallet_id = $is_valid_deposit->user_wallet->main_wallet_id;
            // MainWallet::where([
            //     'id' => $main_wallet_id
            //     ])->increment('total_traded', $is_valid_deposit->amount);


            // update current invested
            User::where('id', $is_valid_deposit->user_id)->increment('currently_invested', $is_valid_deposit->amount);

            return response()->json(
                [
                    'success' => ['message' => ['Deposit approved successfully']]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Something is not right']]
            ], 201
        );


    }

    public function deny(Request $request, Deposit $deposit) {
        // authenticate admin

        // approve deposit
        $deposit_id = $request->id;
        $is_valid_deposit = $deposit->where('id', $deposit_id)->first();

        if(!$is_valid_deposit) {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit request not found']]
                ], 404
            );
        }

        if($is_valid_deposit->status == 'accepted') {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit already approved']]
                ], 208
            );
        }

        if($is_valid_deposit->status == 'denied') {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit already denied']]
                ], 208
            );
        }

        $deny_deposit = $deposit->where('id', $deposit_id)->update(
            [
                'status' => 'denied',
                'denied_at' => date("Y-m-d H:i:s")
            ]);
        

        if($deny_deposit) {
            ChildInvestmentPlan::where('id', $is_valid_deposit->child_investment_plan_id)->increment('total_denied', $is_valid_deposit->amount);
            // send email
            $user = User::find($is_valid_deposit->user_id);

            $details = [
                'subject' => 'Your Deposit Has Been Denied',
                'username' => $is_valid_deposit->user->name,
                'amount' => $is_valid_deposit->amount,
                'transaction_hash' => $is_valid_deposit->transaction_hash,
                'wallet' => $is_valid_deposit->user_wallet->currency,
                'duration' => $is_valid_deposit->plan->duration,
                'plan' => $is_valid_deposit->plan->name,
                'date' => date("Y-m-d H:i:s"),
                'email' => $user->email,
                'view' => 'emails.user.depositdenied'
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);

            return response()->json(
                [
                    'success' => ['message' => ['Deposit denied successfully']]
                ], 201
            );
        }

        return response()->json(
            [
                'errors' => ['message' => ['Something is not right']]
            ], 201
        );
    }

    public function delete(Request $request, Deposit $deposit) {
        // authenticate admin

        // delete deposit
        $deposit_id = $request->id;
        $is_valid_deposit = $deposit->where('id', $deposit_id)->first();

        if(!$is_valid_deposit) {
            return response()->json(
                [
                    'errors' => ['message' => ['Deposit not found']]
                ], 404
            );
        } else {
            $delete_deposit = $deposit->where('id', $deposit_id)->delete();
            if($delete_deposit){
                return response()->json(
                    [
                        'success' => ['message' => ['Deposit Deleted']]
                    ], 201
                );
            }
        }
    }

}
