<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'transaction_hash',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_wallet_id',
        'status',
        'approved_at',
        'denied_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_wallet() {
        return $this->belongsTo(UserWallet::class, 'user_wallet_id');
    }
}
