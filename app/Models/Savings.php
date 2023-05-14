<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Savings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'target',
        'saved',
        'description',
        'name',
        'savings_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
