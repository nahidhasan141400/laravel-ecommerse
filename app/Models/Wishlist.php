<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Productimage;
class Wishlist extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public static function totalWishlistIteams()
    {
        
        if(Auth::guard('supplier')->check())
        {
            $wishlist=Wishlist::where('user_id',Auth::guard('supplier')->id())
                    ->where('purchase_id',NULL)
                    ->orWhere('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->groupBy('product_id')
                    ->get();
        }else{
            $wishlist=Wishlist::where('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->groupBy('product_id')
                    ->get();
        }
        $total_iteams=0;
        foreach($wishlist as $wishlists)
        {
            // $total_iteams=$total_iteams+$wishlists->product_quentity;
            $total_iteams++;
        }
        return $total_iteams;
    }

    public static function totalWishlist()
    {
        if(Auth::guard('supplier')->check())
        {
            $wishlist=Wishlist::where('user_id',Auth::guard('supplier')->id())
                    ->where('purchase_id',NULL)
                    ->orWhere('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->get();
            
        }else{
            $wishlist=Wishlist::where('ip',request()->ip())
                    ->where('purchase_id',NULL)
                    ->get();
        }
        return $wishlist;
    }
}
