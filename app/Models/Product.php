<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'details_id',
        'quantity',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function detail(){
        return $this->belongsTo(ProductDetail::class);
    }


}
