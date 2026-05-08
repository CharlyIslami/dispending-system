<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use App\Models\Category;

class Transaction extends Model
{
    protected $fillable = [
        'category_id',
        'wallet_id',
        'amount',
        'note',
        'date',
    ];

    public function wallet() {
        return $this->belongsTo(Wallet::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
