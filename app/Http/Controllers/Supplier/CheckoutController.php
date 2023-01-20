<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; 
use App\Models\Productimage;
use App\Models\Cart; 
use App\Models\Checkout; 
use App\Models\Supplier; 
use App\Models\Couponused; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Library\SslCommerz\SslCommerzNotification;
use DB;
class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }
    public function checkout(Request $request)
    {
        $supplier=Supplier::find(Auth::guard('supplier')->id());
        return view('supplier.frontend.checkout',compact('supplier'));
    }
    public function checkout_submit(Request $request)
    {
       
        if($request->payment_address!="existing")
        {
            $request->validate([
                'name' => 'required',
                'payment_address' => ['required','string'],
                'number'=>'required',
                'delevery'=>'required',
                'cart_details'=>'required'
            ]);
        }
        $cart_ids=explode(",",$request->cart_details);
        if($request->payment=="cash_in")
        {
            $request_all=$request->all();
            $id=Auth::guard('supplier')->id();
            $cart_ids=$request->cart_details;
            return view('exampleEasycheckout',compact('request_all','id','cart_ids'));
        }
       
       
        $order_code=rand(100000,999999);

        foreach($cart_ids as $cart_id)
        {
            if($cart_id!="")
            {
                $checkout= new Checkout();
                $checkout->customer_id=Auth::guard('supplier')->id();
                $cart=Cart::where('user_id',$checkout->customer_id)
                            ->where('purchase_id',NULL)
                            ->where('id',$cart_id)
                            ->orWhere('ip',request()->ip())
                            ->where('purchase_id',NULL)
                            ->where('id',$cart_id)
                            ->first();
                $cart->purchase_id=1;
                $cart->voucher_no=$order_code;
                $cart->save();

                $payment_method=$request->payment_method;
                if($payment_method=="cash_on")
                {
                    $checkout->payment_method= $payment_method;
                    $checkout->is_paid=0;
                }else{
                    $checkout->payment_method= $payment_method;
                    $checkout->is_paid=1;
                }
                $checkout->order_code=$order_code;
                $checkout->cart_details=$cart_id;
                
                if($request->payment_address=="existing")
                {
                    $checkout->name=Auth::user()->name;
                    $checkout->phone=Auth::user()->phone;
                    $checkout->address=Auth::user()->address;
                }else{
                    $checkout->name=$request->name;
                    $checkout->phone=$request->number;
                    $checkout->address=$request->address;
                }
                $checkout->amount=$request->total_price;
                $checkout->is_completed=0;
                $checkout->ip_address=request()->ip();
                $checkout->shipping_area=$request->delevery;
                $checkout->save();

                $product=Product::find($cart->product_id);
                $product_current_stock=$product->current_stock-$cart->product_quentity;
                $product->current_stock=$product_current_stock;
                $product->save();
            }
           
        }
      
        session()->flash('success','Order added successfully');
        return redirect()->route('home');
        
    }
    
}
