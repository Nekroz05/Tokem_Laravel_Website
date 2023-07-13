<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductDetail;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category'
    ];

    public function details(){
        return $this->hasMany(ProductDetail::class);
    }

}


