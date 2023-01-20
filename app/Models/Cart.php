<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Productimage;


class Cart extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function totalIteams()
    {
        
        if(Auth::guard('supplier')->check())
        {
            $cart=Cart::where('user_id',Auth::guard('supplier')->id())
                    ->where('purchase_id',NULL)
                    ->orWhere('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->get();
        }else{
            $cart=Cart::where('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->get();
        }
        $total_iteams=0;
        foreach($cart as $carts)
        {
            $total_iteams=$total_iteams+$carts->product_quentity;
        }
        return $total_iteams;
    }

    public static function totalCarts()
    {
        if(Auth::guard('supplier')->check())
        {
            $cart=Cart::where('user_id',Auth::guard('supplier')->id())
                    ->where('purchase_id',NULL)
                    ->orWhere('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    // ->groupBy('product_id')
                    ->get();
        }else{
            $cart=Cart::where('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    // ->groupBy('product_id')
                    ->get();
        }
        return $cart;
    }

    public static function totalCartsPrice()
    {
        $price=0;
        foreach(Cart::totalCarts() as $cart_details)
        {
            $discount=$cart_details->product->discount;
            $total_price=$cart_details->product->unit_price-$discount;
            $price=$price+($total_price*$cart_details->product_quentity);
        }
        return $price;
    }
  
}
