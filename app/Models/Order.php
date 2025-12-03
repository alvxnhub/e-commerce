<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
        'product_id',
        'product_name',
        'customer_name',
        'email',
        'phone',
        'address',
        'quantity',
        'total_price',
        'user_id',
    ];

     public function product()
    {
        return $this->belongsTo(Product::class);
    }

}


