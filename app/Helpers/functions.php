<?php

use App\Models\LockedFunds;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserAccountData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Currency\Util\CurrencySymbolUtil;

function generateTransactionHash($table, $column, $length) {
    $hash = bin2hex(random_bytes($length));
    $check_hash_exist = $table->where($column, $hash)->first();

    if($check_hash_exist) {
        generateTransactionHash($table, $column, $length);
    }

    return $hash;
}

function addDaysToDate($dateString, String $days) {
    $date = date_create($dateString);
    date_add($date, date_interval_create_from_date_string($days . ' days'));
    return date_format($date, 'Y-m-d H:i:s');
}

function isUpTo24Hours($datefromdatabase) {
    $timefromdatabase = strtotime($datefromdatabase);
    $dif = time() - $timefromdatabase;

    return $dif >= 86400;
}

function generateAccountNumber($table, $column, $length = 10, $initial = 22) {
    $length_of_number_to_generate = $length - (strlen((string) $initial) + 1);

    $min = pow(10, $length_of_number_to_generate);
    $max = pow(11, $length_of_number_to_generate);

    $number = $initial . rand($min, $max);

    $check_hash_exist = $table->where($column, $number)->first();

    if($check_hash_exist) {
        generateAccountNumber($table, $column, $length = 10, $initial = 22);
    }

    return $number;

}

function get_day_name($timestamp) {
    $date = date_create($timestamp);
    // return $date;

    if(date_format($date, 'd/m/Y') == date('d/m/Y')) {
      $date = 'Today';
    } 
    else if(date_format($date, 'd/m/Y') == date('d/m/Y', now()->timestamp - (24 * 60 * 60))) {
      $date = 'Yesterday';
    } else {
        $date = date_format($date, 'M d, Y');
    }
    return $date;
}

function get_day_format($timestamp) {
    $date = date_create($timestamp);

    $date = date_format($date, 'M d, Y H:i A');

    return $date;
}

function notify($message, $title, $user_id, $is_transaction = false, $type = null) {
    $notify = Notification::insert([
        'user_id' => $user_id,
        'message' => $message,
        'title' => $title,
        'transaction' => $is_transaction,
        'type' => $type,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    return $notify;
}

function isNoon() {
    $users = User::all();
    foreach($users as $user) {
        $date = date_create($user->is_twenty_four_hours);
        if(date_format($date, 'd/m/Y') != date('d/m/Y')) {
            // return date_format($date, 'd/m/Y');
            User::where('id', $user->id)->update(['is_twenty_four_hours' => date('Y-m-d H:i:s')]);
            UserAccountData::where('user_id', $user->id)->update([
                'total_received' => 0.00,
                'total_sent_out' => 0.00
            ]);
        }
    }
}

function unlockFunds() {
    $lockedFunds = LockedFunds::all();
    foreach($lockedFunds as $fund) {
        $date = date_create($fund->due_date);
        if(date_format($date, 'd/m/Y') == date('d/m/Y')) {
            UserAccountData::where('user_id', $fund->user_id)->increment('account_balance');
            LockedFunds::where('user_id', $fund->user_id)->forceDelete();
            // send email
            $details = [
                'subject' => 'Your Money Was  Unocked',
                'amount' => $fund->amount,
                'transaction_id' => $fund->transaction_id,
                'due_date' => get_day_format($fund->due_date),
                'date_locked' => get_day_format($fund->created_at),
                'sign' => '+',
                'color' => 'green',
                'view' => 'emails.user.moneyunlocked',
            ];

            $mailer = new \App\Mail\MailSender($details);
            Mail::to($fund->user->email)->send($mailer);

        }
    }

}

function currency_conversion($currency, $amount) {
    // Fetching JSON
    $req_url = 'https://api.exchangerate-api.com/v4/latest/GBP';
    $response_json = file_get_contents($req_url);

    // Continuing if we got a result
    if(false !== $response_json) {

        // Try/catch for json_decode operation
        try {

        // Decoding
        $response_object = json_decode($response_json);

        // YOUR APPLICATION CODE HERE, e.g.
        //$base_price = 12; // Your price in USD
        $price = round(($amount * $response_object->rates->$currency), 2);

        echo number_format($price, 2);

        }
        catch(Exception $e) {
            // Handle JSON parse error...
        }
    }
}

function get_currency_symbol($currency) {
    
    $symbol = CurrencySymbolUtil::getSymbol($currency);
    return $symbol;
}

function returnCurrencyLocale($currency, $amount) {
    // Fetching JSON
    $req_url = 'https://api.exchangerate-api.com/v4/latest/GBP';
    $response_json = file_get_contents($req_url);

    // Continuing if we got a result
    if(false !== $response_json) {

        // Try/catch for json_decode operation
        try {

        // Decoding
        $response_object = json_decode($response_json);

        // YOUR APPLICATION CODE HERE, e.g.
        //$base_price = 12; // Your price in USD
        $price = round(($amount * $response_object->rates->$currency), 2);

        return  CurrencySymbolUtil::getSymbol($currency) . number_format($price, 2);

        }
        catch(Exception $e) {
            // Handle JSON parse error...
        }
    }
}
