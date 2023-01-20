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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Orders</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>Num. of Products</th>
                                    <th>Amount</th>
                                    <th>Delevery Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($sales as $sale)
                                <tr>
                                    <td>{{$sale->order_code}}</td>
                                   
                                    @php
                                        $carts=explode(",",$sale->cart_details);
                                        $price=0;
                                        $total_cart_price=0;
                                        $vat=0;
                                        $shipping_cost=0;
                                        $total_product=0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            if ($cart=="") {
                                                $item="";
                                            } else {  
                                                $item=App\Models\Cart::find($cart);
                                             
                                                if($item->flashdeal_id!=NULL)
                                                {
                                                    $flash_product=App\Models\Flashdeal::find($item->flashdeal_id);
                                                    $discount=$item->product->unit_price*($flash_product->discount/100);
                                                }else
                                                {
                                                    $discount=$item->product->discount;
                                                }
                                                $total_price=$item->product->unit_price-$discount;
                                              
                                                $tax= $item->product->vat;
                                                $vat=$vat+($total_price*($tax/100)*$item->product_quentity);
                                                if($sale->shipping_area==1)
                                                {
                                                    $shipping_cost=20+$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                                                }else{
                                                    $shipping_cost=$shipping_cost+$item->product->shipping_cost*$item->product_quentity;
                                                }
                                                $total_cart_price=round($total_cart_price+($total_price*$item->product_quentity));
                                               
                                                $total_product=$total_product+$item->product_quentity;
                                            }
                                        @endphp  
                                    @endforeach
                                    <td>{{$total_product}}</td>
                                    <td>TK {{$total_cart_price+$shipping_cost+$vat}}.00 Tk</td>
                                    <td>
                                        @if ($sale->is_completed==0)
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="Pending">
                                                <i class="btn btn-danger">Pending</i>
                                            </a>
                                        </span> 
                                        @elseif($sale->is_completed==1)
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="On review">
                                                <i class="btn btn-info">On review</i>
                                            </a>
                                        </span>
                                        @elseif($sale->is_completed==2)
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="On delivery">
                                                <i class="btn btn-warning">On delivery</i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="Delivery">
                                                <i class="btn btn-secondary">Delivery</i>
                                            </a>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($sale->is_paid==0)
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="Unpaid">
                                                <i class="btn btn-danger">Unpaid</i>
                                            </a>
                                        </span> 
                                        @else
                                        <span class="view">
                                            <a href=""   data-toggle="tooltip" data-placement="top" title="Paid">
                                                <i class="btn btn-primary">Paid</i>
                                            </a>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($sale->id);
                                            $order_code=Crypt::encrypt($sale->order_code);
                                        @endphp
                                        
                                        <span class="edit">
                                            <a href="{{route('purchase_details',$order_code)}}"  data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="view">
                                                    <i class="fa fa-eye color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        
                                    </td>
                                </tr>
                              @endforeach
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