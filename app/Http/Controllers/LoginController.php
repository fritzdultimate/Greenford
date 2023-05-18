<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAccountData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
               $user_ip = getenv('REMOTE_ADDR');
                $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
                $country = $geo["geoplugin_countryName"];
                $city = $geo["geoplugin_city"];

                $details = [
                    'name' => Auth::user()->fullname,
                    'subject' => "A Login Was Attempted On Your Account",
                    'date' => get_day_format(date("Y-m-d H:i:s")),
                    'device' => request()->userAgent(),
                    'nearest_location' =>  $city . ' ' . $country,
                    'view' => 'emails.user.newlogin',
                ];

                $mailer = new \App\Mail\MailSender($details);
                Mail::to(Auth::user()->email)->send($mailer);
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
