<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavingsLogs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'savings_id',
        'amount',
        'transaction_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function goal() {
        return $this->belongsTo(Savings::class, 'savings_id');
    }
}
