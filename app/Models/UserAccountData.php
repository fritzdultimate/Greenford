<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccountData extends Authenticatable
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'account_number',
        'account_type',
        'total_balance',
        'savings',
        'expenses',
        'account_balance',
        'total_bills',
        'total_incoming',
        'total_outgoing',
        'kyc_level',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
