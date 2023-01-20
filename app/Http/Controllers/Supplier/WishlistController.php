<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Brand; 
use App\Models\Product; 
use App\Models\Productimage;
use App\Models\Wishlist; 

class WishlistController extends Controller
{
    public function wishlist($id)
    { 
        if(Auth::guard('supplier')->check())
        {
            $wishlist=Wishlist::where('product_id',$id)
                       ->where('user_id',Auth::guard('supplier')->id())
                       ->where('purchase_id',NULL)
                       ->first();     
        }else{
            $wishlist=Wishlist::where('ip',request()->ip())
                       ->where('product_id',$id)
                       ->where('purchase_id',NULL)
                       ->first();
        }
        $wishlist_quantity=request('quantity');
        if(!is_null($wishlist) && $wishlist_quantity>1)
        {
            $wishlist->increment('product_quentity',$wishlist_quantity);
        }elseif(!is_null($wishlist))
        {
            $wishlist->increment('product_quentity');
        }elseif($wishlist_quantity>1 )
        {
            $wishlists=new Wishlist();
            if(Auth::guard('supplier')->check())
            {
                $wishlists->user_id=Auth::guard('supplier')->id();
            }
            $wishlists->product_id=$id;
            $wishlists->product_quentity=$wishlist_quantity;
            $wishlists->ip=request()->ip();
            $wishlists->save();
        }else{
            $wishlists=new Wishlist();
            if(Auth::guard('supplier')->check())
            {
                $wishlists->user_id=Auth::guard('supplier')->id();
            }
            $wishlists->product_id=$id;
            $product_image=Productimage::where('product_id',$id)->select('image')->first();
            $wishlists->image=$product_image->image;
            $wishlists->ip=request()->ip();
            $wishlists->save();
            
        }
        return json_encode(['total_items'=>Wishlist::totalWishlistIteams(),'status'=>'success','message'=>'Wishlist added successfully',]);
    }
    public function wishlist_view()
    {
        return view('supplier.frontend.wishlist');
    }
}
