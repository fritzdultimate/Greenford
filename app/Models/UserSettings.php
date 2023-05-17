<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSettings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'dark_mode',
        'transaction_emails',
        '2fac',
        'use_pin_for_transaction'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
