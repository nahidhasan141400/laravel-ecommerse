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
use App\Models\Cart; 
use App\Models\Flashdeal; 

class CartController extends Controller
{
    public function cart($id,Request $request)
    { 
      
       
        $array=explode(',',$id);
        $flashdeal_id="";
        $flash_cart=NULL;
        if(count($array)>1)
        {
            $id=$array[0];
            $flashdeal_id=$array[1];
        }
        $customer_choice=$request->except(['quantity','product_id','_token']);
        $customer_choice=serialize($customer_choice);
        $cart_quantity=request('quantity');
        $cart_quantity=(int)$cart_quantity;

        //check product availability
        if($cart_quantity>1)
        {
            $product=Product::where('id',$id)
                        ->where('current_stock' ,'>', $cart_quantity)
                        ->where('status',1)
                        ->first();
        }else{
            $product=Product::where('id',$id)
                        ->where('current_stock','>',0)
                        ->where('status',1)
                        ->first();
        }
        //check product availability end

         //check product has value or not
         if(empty($product))
         {
             session()->flash('success','Product not available !');
             return json_encode([
                 'error'=>'ok',
                 'url'=>route('home')
                 ]);
         }
        //check product has value or not end

        //check product in cart exists or not
        if(Auth::guard('supplier')->check())
        {
            if($flashdeal_id==NULL)
            {
                $cart=Cart::where('product_id',$id)
                       ->where('user_id',Auth::guard('supplier')->id())
                       ->where('flashdeal_id',NULL)
                       ->where('purchase_id',NULL)
                       ->first();
            }elseif($flashdeal_id!=NULL)
            {
                $cart=Cart::where('product_id',$id)
                       ->where('user_id',Auth::guard('supplier')->id())
                       ->where('flashdeal_id',$flashdeal_id)
                       ->where('purchase_id',NULL)
                       ->first();
            }     
        }else{
            
                if($flashdeal_id==NULL)
                {
                    $cart=Cart::where('ip',request()->ip())
                                ->where('product_id',$id)
                                ->where('flashdeal_id',NULL)
                                ->where('purchase_id',NULL)
                                ->first();
                }elseif($flashdeal_id!=NULL)
                {
                    
                    $cart=Cart::where('ip',request()->ip())
                            ->where('product_id',$id)
                            ->where('flashdeal_id',$flashdeal_id)
                            ->where('purchase_id',NULL)
                            ->first();
                }  
            }
        //check product in cart exists or not end

        //increment multiple quantity without flashdeal
        if(!is_null($cart) && $cart_quantity>1 && $flashdeal_id==NULL)
        {
            $cart->customer_choice=$customer_choice;
            if(count($array)>1)
            {
                $cart->flashdeal_id=$flashdeal_id;
            }
            $cart->save();
            $cart->increment('product_quentity',$cart_quantity);
        } //increment multiple quantity without flashdeal end

        //increment multiple quantity with flashdeal
        elseif(!is_null($cart) && $cart_quantity>1 && $flashdeal_id!=NULL)
        {
           
            $cart->customer_choice=$customer_choice;
            if(count($array)>1)
            {
                $cart->flashdeal_id=$flashdeal_id;
            }
            $flashdeal=Flashdeal::where('id',$flashdeal_id)
                                ->where('product_id',$id)
                                ->first();
            $cart->save();
           
            $cart->increment('product_quentity');
            
        }
         //increment multiple quantity with flashdeal end

        //increment single quantity without flashdeal
         elseif(!is_null($cart) && $flashdeal_id==NULL)
         {
             
             $cart->customer_choice=$customer_choice;
             if(count($array)>1)
             {
                 $cart->flashdeal_id=$flashdeal_id;
             }
             $cart->save();
             $cart->increment('product_quentity');
         }
        //increment single quantity without flashdeal end 

         //increment single quantity with flashdeal
         elseif(!is_null($cart) && $flashdeal_id!=NULL)
         {
             $cart->customer_choice=$customer_choice;
             if(count($array)>1)
             {
                
                 $cart->flashdeal_id=$flashdeal_id;
                 $flashdeal=Flashdeal::where('id',$flashdeal_id)
                                 ->where('product_id',$id)
                                 ->first();
                 if($flashdeal!=NULL)
                 {
 
                     $cart->increment('product_quentity');
                     $cart->save();
                     
                 }
             }
         }
         //increment single quantity with flashdeal end

         elseif($cart_quantity>1)
         {
            
             $carts=new Cart();
             if(Auth::guard('supplier')->check())
             {
                 $carts->user_id=Auth::guard('supplier')->id();
             }
             $carts->product_id=$id;
             if(count($array)>1)
             {
                
                 $carts->flashdeal_id=$flashdeal_id;
                 $flashdeal=Flashdeal::where('id',$flashdeal_id)
                                 ->first();
                 if($flashdeal!=NULL)
                 {
                     $carts->product_quentity=$cart_quantity;
                     $discount=$product->unit_price*($flashdeal->discount/100);
                     $$total_price=$product->unit_price-$discount;
                     $carts->product_price=$total_price;
                 }
             }else{
                 $carts->product_quentity=$cart_quantity;
                 $discount=$product->unit_price*($product->discount/100);
                 $total_price=$product->unit_price-$discount;
                 $carts->product_price=$total_price;
             }
             $carts->product_name=$product->name;
             $product_image=Productimage::where('product_id',$id)->select('image')->first();
             $carts->image=$product_image->image;
             $carts->customer_choice=$customer_choice;
             $carts->ip=request()->ip();
             $carts->save();
         }else{
            $carts=new Cart();
            if(Auth::guard('supplier')->check())
            {
                $carts->user_id=Auth::guard('supplier')->id();
            }
            $carts->product_id=$id;
            if(count($array)>1)
            {
                $carts->flashdeal_id=$flashdeal_id;
                $flashdeal=Flashdeal::where('id',$flashdeal_id)
                                ->first();
                                
                if($flashdeal!=NULL)
                {
                    $carts->increment('product_quentity');
                    $discount=$product->unit_price*($flashdeal->discount/100);
                    $total_price=$product->unit_price-$discount;
                    $carts->product_price=$total_price;
                }
                
            }else{
                $discount=$product->unit_price*($product->discount/100);
                $total_price=$product->unit_price-$discount;
                $carts->product_price=$total_price;
            }
            $carts->product_name=$product->name;
            $product_image=Productimage::where('product_id',$id)->select('image')->first();
            $carts->image=$product_image->image;
            $carts->customer_choice=$customer_choice;
            $carts->ip=request()->ip();
            $carts->save();
        }


        return json_encode([
            'total_items'=>Cart::totalIteams(),
            'totalCarts'=>Cart::totalCarts(),
            'cart_price_details'=>Cart::totalCartsPrice(),
            'status'=>'success',
            'message'=>'Cart added successfully',
            'all'=>$customer_choice
            ]);
    }

    public function buy($id,Request $request)
    { 
        
        $customer_choice=$request->except(['quantity','product_id','_token']);
        $customer_choice=serialize($customer_choice);
        $products=Product::where('id',$id)
                        ->where('current_stock',NULL)
                        ->orWhere('id',$id)
                        ->where('current_stock','<',request('quantity'))
                        ->first();
        if($products!=NULL)
        {
            return json_encode([
            'error'=>'ok'
            ]);
        }
        $product=Product::where('id',$id)
                        ->where('status',1)
                        ->first();
        if(empty($product))
        {
            session()->flash('success','Product not available !');
            return json_encode([
            'error'=>'ok',
            'url'=>route('home')
            ]);
        }

        if(Auth::guard('supplier')->check())
        {
            $cart=Cart::where('product_id',$id)
                       ->where('user_id',Auth::guard('supplier')->id())
                       ->where('purchase_id',NULL)
                       ->first();     
        }else{
            $cart=Cart::where('ip',request()->ip())
                       ->where('product_id',$id)
                       ->where('purchase_id',NULL)
                       ->first();
        }
        $cart_quantity=request('quantity');
        if(!is_null($cart) && $cart_quantity>1)
        {
            $cart->customer_choice=$customer_choice;
            $cart->save();
            $cart->increment('product_quentity',$cart_quantity);
        }elseif(!is_null($cart))
        {
            $cart->customer_choice=$customer_choice;
            $cart->save();
            $cart->increment('product_quentity');
        }elseif($cart_quantity>1)
        {
            $carts=new Cart();
            if(Auth::guard('supplier')->check())
            {
                $carts->user_id=Auth::guard('supplier')->id();
            }
            $carts->product_id=$id;

            $carts->product_name=$product->name;
            $discount=$product->unit_price*($product->discount/100);
            $total_price=$product->unit_price-$discount;
            $carts->product_price=$total_price;

            $carts->product_quentity=$cart_quantity;
            $carts->customer_choice=$customer_choice;
            $carts->ip=request()->ip();
            $carts->save();
        }else{
            if($product==NULL)
            {
                return back();
            }
            $carts=new Cart();
            if(Auth::guard('supplier')->check())
            {
                $carts->user_id=Auth::guard('supplier')->id();
            }
            $carts->product_id=$id;

            $carts->product_name=$product->name;
            $discount=$product->unit_price*($product->discount/100);
            $total_price=$product->unit_price-$discount;
            $carts->product_price=$total_price;


            $product_image=Productimage::where('product_id',$id)->select('image')->first();
            $carts->image=$product_image->image;
            $carts->customer_choice=$customer_choice;
            $carts->ip=request()->ip();
            $carts->save();
            
        }
        return response()->json(['url'=>route('view_cart'),'success'=>'ok']);
    }

    public function remove_cart($id)
    {

        Cart::where('product_id',$id)
            ->where('user_id',NULL)
            ->where('purchase_id',NULL)
            ->delete();
        session()->flash('success','Cart removed successfully');
        return back();
    }
    public function remove_cart_auth($id,$user_id)
    {
        Cart::where('product_id',$id)
            ->where('user_id',$user_id)
            ->where('purchase_id',NULL)
            ->delete();
        session()->flash('success','Cart removed successfully');
        return back();
    }

    public function cart_view()
    {
        return view('supplier.frontend.cart');
    }

    public function update_cart($id)
    {
       
        $cart=Cart::where('purchase_id',NULL)->where('id',$id)->first();
        $product=Product::where('id',$cart->product_id)
                        ->where('status',1)
                        ->first();
        if(empty($product))
        {
            session()->flash('success','Product not available !');
            return back();
        }
        $cart->product_quentity=request('quantity');
        $cart->save();
        return back();
    }

    public function give_review($id,Request $request)
    {
        $cart=Cart::where('user_id',Auth::guard('supplier')->id())->where('purchase_id',1)->where('id',$id)
                    ->orWhere('ip',request()->ip())->where('purchase_id',1)->where('id',$id)->first();
        if(!empty($cart))
        {
            $cart->review=$request->rating;
            $cart->save();
            session()->flash('success','Review added successfully');
            $product=Product::find($cart->product_id);
            $carts=Cart::whereNotNull('review')->get();
            $i=0;
            $review=0;
            if(!empty($product))
            {
                foreach($carts as $cart)
                {
                    $i++;
                    $review=$review+$cart->review;
                }
                
                $product->rating=$review/$i;
                $product->save();

            }
            return back();
        }else{
            return back();
        }
    }
}
