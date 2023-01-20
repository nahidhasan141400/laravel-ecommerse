<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $guarded = [];
    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_details');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'customer_id');
    }
}
