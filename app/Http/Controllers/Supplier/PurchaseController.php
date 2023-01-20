<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Checkout;
use Illuminate\Support\Facades\Crypt;
class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }
    public function purchase()
    {
        $sales=Checkout::where('customer_id',auth()->user()->id)
                       
                        ->get();
       
        return view('supplier.purchase',compact('sales'));
    }
    public function purchase_details($id, Request $request)
    {
        
        try {

            $data = Crypt::decrypt($id);
            $order=Checkout::where('order_code',$data)->first();
            $orders=Checkout::where('order_code',$data)->get();
            return view('supplier.purchase_details',compact('orders','order'));
          
          } catch (\Exception $e) {
          
            return redirect()->route('purchase');
          }
        
    }
}
