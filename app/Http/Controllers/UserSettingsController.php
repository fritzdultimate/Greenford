<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingsController extends Controller {
    public function updateMode(Request $request) {
        UserSettings::where('user_id', Auth::user()->id)->update(['dark_mode' => $request->dark_mode]);

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
            return response()->json(
                [
                    'success'=> ['message' => ["password has been changed successfully"]]
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

        return response()->json(
            [
                'success'=> ['message' => [$message]]
            ], 200
        );
    }
}
