<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWithdrawalRequest;
use App\Models\Transactions;
use App\Models\User;
use App\Models\SiteSettings;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WithdrawalController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWithdrawalRequest $request, Withdrawal $withdrawal) {
        $user_id = Auth::id();

        $validated = $request->validated();

        $hash = generateTransactionHash($withdrawal, 'transaction_hash', 25);
        $wallet_id_is_valid = UserWallet::where('id', $validated['user_wallet_id'])->first();
        

        if(!$wallet_id_is_valid) {
            return response()->json(
                [
                    'errors' => ['message' => ['Invalid wallet for this transaction']]
                ], 400
            );
        }
        
        $user = User::find($user_id);

        if($user->deposit_balance < $validated['amount']) {
            return response()->json(
                [
                    'errors' => ['message' => ['Insufficient fund for this transaction']]
                ], 403
            );
        }

       $data = [
           'user_id' => $user_id,
           'transaction_hash' => $hash,
           'user_wallet_id' => $validated['user_wallet_id'],
           'amount' => $validated['amount'],
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s')
       ];

        $insert_data = $withdrawal->insert($data);

        if($insert_data) {
            $wallet = UserWallet::find($validated['user_wallet_id']);
            Transactions::insert([
                'amount' => $validated['amount'],
                'user_id' => $user_id,
                'currency' => $wallet->admin_wallet->currency,
                'transaction_hash' => $hash,
                'type' => 'withdrawal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            // send email
            
            
            

            $details = [
                'subject' => 'You Have Successfully Created A Withdrawal Request, Awaiting Confirmation',
                'email' => $user->email,
                'site_address' => env('SITE_ADDRESS'),
                'amount' => $validated['amount'],
                'transaction_hash' => $hash,
                'wallet' => $wallet->admin_wallet->currency,
                'wallet_address' => $wallet->currency_address,
                'date' => date("Y-m-d H:i:s"),
                'view' => 'emails.user.withdrawalrequest',
                'username' => ucfirst(Auth::user()['name'])
            ];

            $admins = User::where(['is_admin' => 1, 'permission' => '1'])->get();
            $mailer = new \App\Mail\MailSender($details);
            Mail::to($user->email)->send($mailer);
            $details['view'] = 'emails.admin.withdrawalrequest';
            $details['subject'] = 'A User Has Requested For Withdrawal';
            $details['username'] = $user->name;

            // send to admins
            foreach($admins as $admin) {
                $mailer = new \App\Mail\MailSender($details);
                Mail::to($admin->email)->send($mailer);
            }

            return response()->json(
                [
                    'success' => ['message' => ['Withdrawal request created, please check your email for more details.']]
                ], 201
            );
        }
    }

    public function approve(Request $request, Withdrawal $withdrawal) {
        // authenticate admin

        // approve withdraw
        $withdrawal_id = $request->id;
        $is_valid_withdraw = $withdrawal->find($withdrawal_id);

        if(!$is_valid_withdraw) {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request not found']]
                ], 404
            );
        }

        if($is_valid_withdraw->status == 'accepted') {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request already approved']]
                ], 208
            );
        }

        if($is_valid_withdraw->status == 'denied') {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request already denied']]
                ], 208
            );
        }

        // check if user has enough balance before debiting
        $user_details = User::find($is_valid_withdraw->user_id);

        if($user_details->deposit_balance < $is_valid_withdraw->amount) {
            // send user site notification about transaction approval failure
            return response()->json(
                [
                    'errors' => ['message' => ['Error approving this request, user has insufficient funds.']]
                ], 400
            );
        }

        $decrement_deposit_balance = User::where('id', $is_valid_withdraw->user_id)->decrement('deposit_balance', $is_valid_withdraw->amount);
        if($decrement_deposit_balance) {
            $approved_withdrawal = $withdrawal->where('id', $withdrawal_id)->update(
                [
                    'status' => 'accepted',
                    'approved_at' => date("Y-m-d H:i:s")
                ]);

            if($approved_withdrawal) {
                // send email
                $user = User::find($is_valid_withdraw->user_id);

                $details = [
                    'subject' => 'Your Withdrawal Request Has Been Processed And Approved',
                    'amount' => $is_valid_withdraw->amount,
                    'transaction_hash' => $is_valid_withdraw->transaction_hash,
                    'wallet' => $is_valid_withdraw->user_wallet->admin_wallet->currency,
                    'wallet_address' => $is_valid_withdraw->user_wallet->currency_address,
                    'date' => date("Y-m-d H:i:s"),
                    'view' => 'emails.user.withdrawalapproved',
                    'username' => $user->name,
                    'email' => $user->email
                ];

                $mailer = new \App\Mail\MailSender($details);
                Mail::to($user->email)->send($mailer);

                $admins = User::where(['is_admin' => 1, 'permission' => '1'])->get();
                $details['view'] = 'emails.admin.withdrawalapproved';
                $details['subject'] = 'A Withdrawal Request Was Approved';

                // send to admins
                foreach($admins as $admin) {
                    $mailer = new \App\Mail\MailSender($details);
                    Mail::to($admin->email)->send($mailer);
                }

                // update wallet transaction count
                // AdminWallet::where([
                //     'id' => $is_valid_withdraw->user_wallet->admin_wallet_id
                // ])->increment('total_traded', $is_valid_withdraw->amount);

                // update total withdrawn
                User::where('id', $is_valid_withdraw->user_id)->increment('total_withdrawn', $is_valid_withdraw->amount);

                return response()->json(
                    [
                        'success' => ['message' => ['Withdrawal approved.']]
                    ], 201
                );
            }
        } else {
            return response()->json(
                [
                    'errors' => ['message' => ['something unexpectedly went wrong.']]
                ], 500
            );
        }


    }

    public function deny(Request $request, Withdrawal $withdrawal) {
        // authenticate admin

        // deny withdraw
        $withdrawal_id = $request->id;
        $is_valid_withdrawal = $withdrawal->find($withdrawal_id);

        if(!$is_valid_withdrawal) {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request not found']]
                ], 404
            );
        }

        if($is_valid_withdrawal->status == 'accepted') {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request already approved']]
                ], 208
            );
        }

        if($is_valid_withdrawal->status == 'denied') {
            return response()->json(
                [
                    'errors' => ['message' => ['Withdrawal request already denied']]
                ], 208
            );
        }

        if($is_valid_withdrawal) {
            $denied_withdrawal = $withdrawal->where('id', $withdrawal_id)->update(
                [
                    'status' => 'denied',
                    'denied_at' => date("Y-m-d H:i:s")
                ]);

            if($denied_withdrawal) {
                // send email
                $user = User::find($is_valid_withdrawal->user_id);

                $details = [
                    'subject' => 'Your Withdrawal Request Has Been Denied',
                    'amount' => $is_valid_withdrawal->amount,
                    'transaction_hash' => $is_valid_withdrawal->transaction_hash,
                    'wallet' => $is_valid_withdrawal->user_wallet->admin_wallet->currency,
                    'wallet_address' => $is_valid_withdrawal->user_wallet->currency_address,
                    'date' => date("Y-m-d H:i:s"),
                    'view' => 'emails.user.withdrawaldenied',
                    'username' => $user->name,
                    'email' => $user->email
                ];

                $mailer = new \App\Mail\MailSender($details);
                Mail::to($user->email)->send($mailer);

                $admins = User::where(['is_admin' => 1, 'permission' => '1'])->get();
                $details['view'] = 'emails.admin.withdrawaldenied';
                $details['subject'] = 'A Withdrawal Request Was Denied';

                // send to admins
                foreach($admins as $admin) {
                    $mailer = new \App\Mail\MailSender($details);
                    Mail::to($admin->email)->send($mailer);
                }

                return response()->json(
                    [
                        'success' => ['message' => ['Withdrawal denied.']]
                    ], 201
                );
            }
        } else {
            return response()->json(
                [
                    'errors' => ['message' => ['something unexpectedly went wrong.']]
                ], 500
            );
        }
    }
    
    public function delete(Request $request, Withdrawal $withdrawal) {
        $withdrawal_id = $request->id;
        $is_valid_withdrawal = $withdrawal->where('id', $withdrawal_id)->first();

        if(!$is_valid_withdrawal) {
            return response()->json(
                [
                    'errors' => ['message' => ['withdrawal not found']]
                ], 404
            );
        } else {
            $delete_withdrawal = $withdrawal->where('id', $withdrawal_id)->delete();
            if($delete_withdrawal){
                return response()->json(
                    [
                        'success' => ['message' => ['withdrawal Deleted']]
                    ], 201
                );
            }
        }
    }


}