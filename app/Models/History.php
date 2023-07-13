<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cart;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paid',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

}
