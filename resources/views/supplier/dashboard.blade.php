@extends('supplier.app')
@section('content')
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        @php
                            $quantity=0;
                        @endphp
                        @foreach (App\Models\Cart::totalCarts() as $item)
                            @php
                                $quantity=$quantity+$item->product_quentity;
                            @endphp 
                        @endforeach 
                        <h3 class="card-title text-white">{{$quantity}} Products</h3>
                        <div class="d-inline-block">
                            <p class="text-white mb-0">
                                In your cart
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">{{App\Models\Wishlist::totalWishlistIteams()}} Products</h3>
                        <div class="d-inline-block">
                            <p class="text-white mb-0">
                                In your wishlist
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                       
                        @foreach ($orders as $order)
                            @php
                                $carts=explode(",",$order->cart_details);
                                $total_product=0;
                            @endphp
                            @foreach ($carts as $cart)
                            @php
                                if ($cart=="") {
                                    $item="";
                                } else {  
                                    $item=App\Models\Cart::find($cart);
                                    $total_product=$total_product+$item->product_quentity;
                                }
                            @endphp  
                        @endforeach
                        @endforeach
                        <h3 class="card-title text-white">{{!empty($total_product)?$total_product:0}} Products</h3>
                        <div class="d-inline-block">
                            <p class="text-white mb-0">
                                You ordered
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-shopping-basket"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">Saved Shipping Info
                        </h3>
                        <div class="d-inline-block">
                            <p class="text-white mb-0">
                               <a style="color: #007bff" href="{{route('manage_profile')}}">Edit</a>
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection