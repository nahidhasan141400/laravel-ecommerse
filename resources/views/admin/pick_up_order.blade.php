@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pick Up Point</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Order Code</th>
                                    <th>Num. of Products</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Delevery Status</th>
                                    <th>Payment Status</th>
                                    <th>Pick Up Point</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($sales as $sale)
                                <tr>
                                    <td style="display: none">{{$sale->id}}</td>
                                    <td>{{$sale->order_code}}</td>
                                   
                                    @php
                                        $carts=explode(",",$sale->cart_details);
                                        $price=0;
                                        $quentity=0;
                                        $total_cart_price=0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $cart_item=App\Models\Cart::find($cart);
                                            $discount=$cart_item->product->unit_price*($cart_item->product->discount/100);
                                            $total_price=$cart_item->product->unit_price-$discount;
                                            $total_cart_price=$total_cart_price+($total_price*$cart_item->product_quentity);
                                            $tax=$cart_item->product_quentity*$cart_item->product->tax;
                                            $total=$total_cart_price+$tax;
                                            $price=$price+$total;
                                            $quentity=$quentity+$cart_item->product_quentity;
                                            $total_cart_price=0;
                                        @endphp  
                                    @endforeach
                                   
                                    <td>{{$quentity}}</td>
                                    <td>{{$sale->supplier->name}}</td>
                                    <td>{{ceil($price)}}.00 TK</td>
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
                                    <td>{{$sale->address}}</td>
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