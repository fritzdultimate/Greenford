<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAccountData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function index(Request $request) {

        // if($request->isMethod('get')) {
        //     $page_title = "Login | SilvercapitalTrade - Investment Website";
        //     return view('auth.login.user', compact('page_title'));
        // }

        $password = $request->password;

        $user = UserAccountData::where('account_number', $request->account_number)->first();

        if(!$user) {
            return redirect('/login')->with('error', 'Account not found.');
        } else {
            $data = User::where('id', $user->user_id)->first();
            if(!password_verify($password, $data->password)) {
                return redirect('/login')->with('error', 'Password is incorrect');
            } elseif(!$data->email_verified_at) {
                return redirect('/login')->with('error', 'Please verify your account before attempting login!');
            } else {

               Auth::login($data, true);
               return redirect('/user')->with('success', 'Access granted');
            }
            return redirect('/login')->with('error', 'Something went wrong, we are working on it');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/app/login');
    }
}
