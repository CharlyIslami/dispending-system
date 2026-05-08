<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'currency_id',
        'name',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
