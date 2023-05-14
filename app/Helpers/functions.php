<?php

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
