@extends('supplier.app')
@section('content')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
               
            </ol>
        </div>
    </div>
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h4 class="card-title">Orders Details</h4>
            <p style="margin-bottom: 0;margin-top:5px;">Order Code: {{$order->order_code}} </p>
            <p style="margin-bottom: 0">Order Date: {{$order->created_at}}</p>
            <p class="btn btn-primary" style="margin-bottom: 0">Order Status: 
                {{ $order->is_completed==0 ? 'Pending' : ($order->is_completed==1 ? 'On review': ($order->is_completed==2 ? 'On delivery':"Delivery")) }}
            </p>
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
                                    <th>Quentity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                   
                                    $price=0;
                                    $total_cart_price=0;
                                    $vat=0;
                                    $shipping_cost=0;
                                @endphp
                                @foreach ($orders as $order)
                                    @php
                                   
                                        if($order!="")
                                        {
                                            $item=App\Models\Cart::find($order->cart_details);
                                           
                                            if($item->flashdeal_id!=NULL)
                                            {
                                                $flash_product=App\Models\Flashdeal::find($item->flashdeal_id);
                                                $discount=$item->product->unit_price*($flash_product->discount/100);
                                            }else
                                            {
                                                $discount=$item->product->discount;
                                            }
                                            $total_price=$item->product->unit_price-$discount;
                                            $total_cart_price=round($total_cart_price+($total_price*$item->product_quentity));
                                            $tax= $item->product->vat;
                                            $vat=$vat+($total_price*($tax/100)*$item->product_quentity);
                                            if($order->shipping_area==1)
                                            {
                                                $shipping_cost=20+$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                                            }else{
                                                $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                                            }
                                        }else{
                                            $item="";
                                        }
                                    @endphp  
                                    @if ($item!=NULL)
                                        <tr>
                                            <td>{{$item->product->name}}</td>
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