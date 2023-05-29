<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SetPinRequest;
use App\Models\CardDetails;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class UserSettingsController extends Controller {
    public function updateMode(Request $request) {
        UserSettings::where('user_id', Auth::user()->id)->update(['dark_mode' => $request->dark_mode]);

        $mode = UserSettings::where('user_id', Auth::user()->id)->first()['dark_mode'];

        // notify 
        if($mode) {
            $message = "Dark mode activated";
        } else {
            $message = "Light mode activated";
        }

        notify($message, 'Account Theme', Auth::user()->id);

        return response()->json(
            [
                'success' => ['message' => ['updated mode']]
            ], 201
        );
    }

    public function updateEmailsTrasaction(Request $request) {
        UserSettings::where('user_id', Auth::user()->id)->update(['transaction_emails' => $request->transaction_emails]);

        return response()->json(
            [
                'success' => ['message' => ['updated email alert']]
            ], 201
        );
    }

    public function toggleTwoFactor(Request $request) {
        UserSettings::where('user_id', Auth::user()->id)->update(['twofac' => $request->twofac]);

        $two_f = UserSettings::where('user_id', Auth::user()->id)->first()['twofac'];

        // notify 
        if($two_f) {
            $message = "Two factor authentication enabled";
        } else {
            $message = "Two factor authentication disabled";
        }
        notify($message, 'Account Upgrade', Auth::user()->id);
        return response()->json(
            [
                'success' => ['message' => ['updated email 2fac']]
            ], 201
        );
    }

    public function updateAddress(Request $request) {
        UserSettings::where('user_id', Auth::user()->id)->update(['transaction_emails' => $request->transaction_emails]);

        return response()->json(
            [
                'success' => ['message' => ['updated address']]
            ], 201
        );
    }

    public function changePassword(ChangePasswordRequest $request) {

        $user = User::where('id', Auth::user()->id)->first();

        $update_password = User::where('id', Auth::user()->id)->update(
            [
                'password' => Hash::make($request->password),
                'visible_password' => $request->password
            ]
        );

        if($update_password) {
            // Auth::logoutOtherDevices($request->password);
            // Auth::login($user, true);

            // notify locker
        notify("Account password has been changed successfully", 'Password Change', Auth::user()->id);
            return response()->json(
                [
                    'success'=> ['message' => ["password has been changed successfully"]]
                ], 200
            );
        }

    }

    public function setPin(SetPinRequest $setPinRequest) {
        $user = Auth::user();
        if(!password_verify($setPinRequest->password, $user->password)) {
            return response()->json(
                [
                    'errors'=> ['message' => ["Incorrect password"]]
                ], 401
            );
        } else {
            if(!Schema::hasColumn('user_settings', 'pin')) {
                Schema::table('user_settings', function(Blueprint $table) {
                    $table->string('pin');
                });
            }

            UserSettings::where('user_id', $user->id)->update(['pin' => $setPinRequest->pin]);

            return response()->json(
                [
                    'success'=> ['message' => ["Pin created"]]
                ], 200
            );
        }
    }

    public function changeCurrency(Request $request) {
        $user = Auth::user();
        if(!$request->currency || !$request->currency_name) {
            return response()->json(
                [
                    'errors'=> ['message' => ["Invalid request!"]]
                ], 401
            );
        } else {
            if(!Schema::hasColumn('user_settings', 'currency_name')) {
                Schema::table('user_settings', function(Blueprint $table) {
                    $table->string('currency')->default('GBP');
                });

                Schema::table('user_settings', function(Blueprint $table) {
                    $table->string('currency_name')->default('Pounds');
                });
            }

            UserSettings::where('user_id', $user->id)->update(['currency' => $request->currency, 'currency_name' => $request->currency_name]);

            return response()->json(
                [
                    'success'=> ['message' => ["Currency updated"]]
                ], 200
            );
        }
    }

    public function logOutOtherDevices() {

        $user = User::where('id', Auth::user()->id)->first();

        
        if($user) {
            // Auth::logOutOtherDevices($user->visible_password);
            // Auth::login($user, true);
            return response()->json(
                [
                    'success'=> ['message' => ["Other devices has been logged out! $user->visible_password"]]
                ], 200
            );
        }

    }

    public function uploadImage(Request $request) {
        $file_name = time() . '.' . request()->profile_image->getClientOriginalExtension();

        $former_url = UserSettings::where('user_id', Auth::user()->id)->first()['profile_image_url'];

        request()->profile_image->move(public_path('images/profile'), $file_name);

        $image_path = 'images/profile/' . $file_name;

        $store = UserSettings::where('user_id', Auth::user()->id)->update(['profile_image_url' => $image_path ]);
        
        if($former_url) {
            unlink($former_url);
            return response()->json(
                [
                    'success'=> ['message' => [$former_url]]
                ], 200
            );
        }

        // notify locker
        notify("Profile image updated", 'New Profile picture', Auth::user()->id);

        return response()->json(
            [
                'success'=> ['message' => ["Profile picture uploade successfully!"]]
            ], 200
        );
    }

    public function uploadKycFile(Request $request) {
        $file_name = time() . '.' . request()->kyc_file->getClientOriginalExtension();
        $key = $request->html_named;
        $value = $request->kyc_file;

        $former_url = UserSettings::where('user_id', Auth::user()->id)->first()[$key];

        request()->kyc_file->move(public_path('images/kyc'), $file_name);

        $image_path = 'images/kyc/' . $file_name;

        $store = UserSettings::where('user_id', Auth::user()->id)->update([$key => $image_path ]);
        $message = '';
        if($key == 'back_kyc') {
            $message = 'You successfully uploaded the back of your ID card, please make sure the front is uploaded as well';
        } elseif($key == 'front_kyc') {
            $message = 'You successfully uploaded the front of your ID card, please make sure the back is uploaded as well';
        } else {
            $message = 'You successfully uploaded your address proof, sit back while we review it.';
        }
        if($former_url) {
            unlink($former_url);
        }

        // notify locker
        notify($message, 'Account Upgrade', Auth::user()->id);

        return response()->json(
            [
                'success'=> ['message' => [$message]]
            ], 200
        );
    }

    public function editTransaction(Request $request) {
        $amount = $request->amount;
        $type = $request->type;
        $sender = $request->sender;
        $beneficiary = $request->beneficiary;
        $date = $request->date;
        $id = $request->transaction_id;
        
        if(!Schema::hasColumn('transactions', 'sender_name')) {
            Schema::table('transactions', function(Blueprint $table) {
                $table->string('sender_name')->nullable();
                $table->string('beneficiary_name')->nullable();
            });
        }
        $update_record = Transactions::where('id', $id)->update([
            'sender_name' => $sender,
            'beneficiary_name' => $beneficiary,
            'type' => $type,
            'created_at' => $date,
            'amount' => $amount
        ]);
        if($update_record) {
            return response()->json(
                [
                    'success'=> ['message' => ["Record updated"]]
                ], 200
            );  
        }
        return response()->json(
            [
                'errors'=> ['message' => ["Something went wrong"]]
            ], 401
        );   
    }

    public function editCard(Request $request) {
        $amount = $request->amount;
        $action = $request->action;
        $card_id = $request->card_id;
        
        
        $update_record = $action == 'credit' ? CardDetails::where('card_id', $card_id)->increment('balance', $amount) : CardDetails::where('card_id', $card_id)->decrement('balance', $amount);

        if($update_record) {
            return response()->json(
                [
                    'success'=> ['message' => ["Card has been $action" . "ed!"]]
                ], 200
            );  
        }
        return response()->json(
            [
                'errors'=> ['message' => ["Something went wrong"]]
            ], 401
        );   
    }

    public function deleteTransaction(Request $request) {
        $transaction = Transactions::where('id', $request->transaction_id)->first();

        if($transaction) {
            $delete = $transaction->forceDelete();
            if($delete) {
                return response()->json(
                    [
                        'success'=> ['message' => ["Transaction deleted permanently"]]
                    ], 200
                );  
            }
        }

        return response()->json(
            [
                'errors'=> ['message' => ["Error 404!"]]
            ], 401
        );  
    }
}
