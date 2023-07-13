<?php

namespace App\Models;

use App\Models\User;
use App\Models\History;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'history_id',
    ];

    public function history(){
        return $this->belongsTo(History::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
