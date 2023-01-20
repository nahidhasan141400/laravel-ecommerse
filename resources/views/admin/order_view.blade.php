@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
@php
    $order_notify=App\Models\Checkout::find($order->id);
    if($order_notify->notify==0)
    {
        $order_notify->notify=1;
        $order_notify->save();
    }
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <h4 class="card-title">Orders Details</h4>
            <p style="margin-bottom: 0;margin-top:5px;">Order Code: {{$order->order_code}} </p>
            <p style="margin-bottom: 0">Order Date: {{$order->created_at}}</p>
            <p class="btn btn-primary" style="margin-bottom: 0">Order Status: 
                {{ $order->is_completed==0 ? 'Pending' : ($order->is_completed==1 ? 'On review': ($order->is_completed==2 ? 'On delivery':"Delivery")) }}
            </p>
        </div>
        <div class="col-3">
            <label class="col-form-label" for="payment_status_admin">Shipping Cost
            </label>
           <form method="post" action="{{route('shipping_cost',$order->id)}}">
                @csrf
                <div class="row">
                    
                        <div class="form-group">
                            <input class="form-control" type="number" name="shipping_cost"/>
                        </div>
                   
                
                        <div class="form-group">
                            <button class="btn btn-primary form-control">Submit</button>
                        </div>
                    
                </div>
           </form>
        </div>
        <div class="col-3">
            <label class="col-form-label" for="payment_status_admin">Payment Status 
            </label>
            @php
                $parameter= Crypt::encrypt($order->id);
            @endphp
            <select  name="{{$parameter}}" id="payment_status_admin" class="form-control">
                <option selected>
                    {{$payment_status=$order->is_paid==0 ? 'Unpaid':'Paid'}}
                </option>
                @if ($payment_status!="Unpaid")
                    <option value="0">Unpaid</option>
                @else
                    <option  value="1">Paid</option>
                @endif
            </select>
        </div>
        <div class="col-3">
            <label class="col-form-label" for="delivery_status_admin">Delivery Status
            </label>
            <select name="{{$parameter}}" id="delivery_status_admin" class="form-control">
                <option selected>
                    {{ $delivery_status=$order->is_completed==0 ? 'Pending' : ($order->is_completed==1 ? 'On review': ($order->is_completed==2 ? 'On delivery':"Delivered")) }}
                </option>
                @if ($delivery_status!="Pending")
                    <option value="0">Pending</option>
                @endif
                @if($delivery_status!="On review")
                    <option  value="1">On Review</option>
                @endif
                @if($delivery_status!="On delivery")
                    <option  value="2">On Delivery</option>
                @endif
                @if($delivery_status!="Delivered")
                    <option  value="3">Delivered</option>
                @endif
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Details</th>
                                    <th>Quentity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $carts=explode(",",$order->cart_details);
                                    $price=0;
                                    $total_cart_price=0;
                                    $vat=0;
                                    $shipping_cost=0;
                                @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        if($cart!="")
                                        {
                                            $item=App\Models\Cart::find($cart);

                                            $flashdeal=explode(",",$item->product_id);
                                            $flashdeal_count=count($flashdeal);
                                            
                                            if($flashdeal_count>1)
                                            {
                                                $flashdeal_check=App\Models\Flashdeal::where('code',$flashdeal[1])->first();
                                                $discount=$item->product->unit_price*($flashdeal_check->discount/100);
                                            
                                            }else{
                                                $discount=$item->product->discount;
                                            }

                                            
                                            $total_price=round($item->product->unit_price-$discount);
                                            $total_cart_price=round($total_cart_price+($total_price*$item->product_quentity));
                                            $tax= $item->product->vat;
                                            $vat=$vat+($total_price*($tax/100)*$item->product_quentity);
                                            $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                                        }else{
                                            $item="";
                                        }
                                    @endphp  
                                    @if ($item!=NULL)
                                        <tr>
                                            <td>{{$item->product->name}}</td>
                                            @php
                                            $customer_choice=unserialize($item->customer_choice);
                                            @endphp
                                            <td>
                                                @foreach ($customer_choice as $key => $value)
                                                @php
                                                    $customer_choice_contents=explode(",",$value);
                                                @endphp
                                                {{$key}}:
                                                @foreach ($customer_choice_contents as $customer_choice_content)
                                                    {{$customer_choice_content}}
                                                @endforeach 
                                                <br/> 
                                                @endforeach  
                                            </td>
                                            <td>{{$item->product_quentity}}</td>
                                            <td>TK {{$total_price}}.00</td>
                                            <td>TK {{$total_price*$item->product_quentity}}.00</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border">
                           
                            <tbody>
                                <tr class="table-primary">
                                    <td style="text-align: center">Sub Total :</td>
                                    
                                    <td>TK {{$total_cart_price}}.00</td>
                                </tr>
                                <tr class="table-success">
                                    <td style="text-align: center">Tax :</td>
                                    <td>TK {{round($vat)}}.00</td>
                                </tr>
                                <tr class="table-info">
                                    <td style="text-align: center">Shipping :</td>
                                    @if ($order->shipping!=NULL)
                                        @php
                                            $shipping_cost=$order->shipping;
                                        @endphp
                                    @elseif ($item->product->shipping_cost!=NULL)
                                        @php
                                           
                                        @endphp
                                    @else
                                        @php
                                            $shipping_cost=0;
                                        @endphp
                                    @endif
                                    <td>TK {{round($shipping_cost)}}.00</td>
                                </tr>
                                <tr class="table-warning">
                                    <td style="text-align: center">Total :	</td>
                                    
                                    <td>TK {{round($total_cart_price+$vat+$shipping_cost)}}.00</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection