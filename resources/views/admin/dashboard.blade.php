@extends('admin.app')
@section('content')
<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Products Sold</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($total_sales as $total_sale)
                                    @php
                                        $total=$total+$total_sale->product_quentity;
                                    @endphp
                                @endforeach
                                {{$total}}
                            </h2>
                            <p class="text-white mb-0">2020/11/04 - 
                                @php
                                    $date=Carbon\Carbon::now()->format('Y-m-d H:i:s')
                                @endphp {{Carbon\Carbon::now()->format('Y/m/d')}}
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Earnings</h3>
                        <div class="d-inline-block">
                            @php
                                $sub_total_profit=0;
                                $price=0;
                                $total_cart_price=0;
                                $vat=0;
                                $shipping_cost=0;
                            @endphp
                            @foreach ($total_sales as $total_sale)
                                @php
                               
                                    if($total_sale->flashdeal_id!=NULL)
                                    {
                                        $flash_product=App\Models\Flashdeal::find($total_sale->flashdeal_id);
                                        $discount=$total_sale->product->unit_price*($flash_product->discount/100);
                                    }else
                                    {
                                        $discount=$total_sale->product->discount;
                                    }
                                    $total_price=$total_sale->product->unit_price-$discount;
                                    $total_cart_price=round($total_cart_price+($total_price*$total_sale->product_quentity));
                                    $tax= $total_sale->product->vat;
                                    $vat=$vat+($total_price*($tax/100)*$total_sale->product_quentity);

                                    $checkout=App\Models\Checkout::where('cart_details',$total_sale->id)->first();
                                    
                                    if($checkout->shipping_area==1)
                                    {
                                        $shipping_cost=20+$shipping_cost+$total_sale->product->shipping_cost*$total_sale->product_quentity;
                                    }else{
                                        $shipping_cost=$shipping_cost+$total_sale->product->shipping_cost*$total_sale->product_quentity;
                                    }

                                    $sub_total_profit=$total_cart_price+$vat+$shipping_cost;
                                @endphp
                            @endforeach
                            <h2 class="text-white">TK. {{ceil($sub_total_profit)}}</h2>
                            <p class="text-white mb-0">2020/11/04 - 
                                @php
                                    
                                    $date=Carbon\Carbon::now()->format('Y-m-d H:i:s')
                                @endphp {{Carbon\Carbon::now()->format('Y/m/d')}}
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <h3 class="card-title text-white">New Customers</h3>
                        <div class="d-inline-block">
                            @php
                                $total_customer=0;
                            @endphp
                            @foreach ($customers as $customer)
                                @php
                                    $total_customer++;
                                @endphp
                            @endforeach
                            <h2 class="text-white">{{ $total_customer}}</h2>
                            <p class="text-white mb-0">2020/11/4 - 
                                @php
                                    $date=Carbon\Carbon::now()->format('Y-m-d H:i:s')
                                @endphp {{Carbon\Carbon::now()->format('Y/m/d')}}
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Customer Satisfaction</h3>
                        <div class="d-inline-block">
                            @php
                                    $total_review=0;
                                    $positive_rating=0;
                                    $negative_rating=0;
                                @endphp
                                @foreach ($total_sales as $total_sale)
                                    @if ($total_sale->review!=NULL)
                                        @php
                                            $total_review++;
                                        @endphp
                                        @if ($total_sale->review>=3)
                                            @php
                                                $positive_rating++;
                                            @endphp
                                        @elseif($total_sale->review<=2)
                                            @php
                                                $negative_rating++;
                                            @endphp
                                     @endif
                                    @endif
                                @endforeach
                                @php
                                    if($total_review!=0)
                                    {
                                        $negative_rating_percent=$negative_rating*(100/$total_review);
                                        $positive_rating_percent=$positive_rating*(100/$total_review);
                                    }else{
                                        $negative_rating_percent=0;
                                        $positive_rating_percent=0;
                                    }
                                @endphp
                            <h2 class="text-white">{{$positive_rating_percent}}%</h2>
                            <p class="text-white mb-0">2020/11/4 - 
                                @php
                                    $date=Carbon\Carbon::now()->format('Y-m-d H:i:s')
                                @endphp {{Carbon\Carbon::now()->format('Y/m/d')}}
                            </p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i style="width:35px" class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div style="display: none"  class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthly_total_sales as $cart)
                                        <tr class="monthly_sale">
                                            <td>{{$cart->updated_at}}</td>
                                            <td>{{$cart->product_quentity}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-0 d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-1">Current Month Order</h4>
                                    <p>Current Month Total Earnings </p>
                                    @php
                                        $monthly_sub_total_profit=0;
                                        $price=0;
                                        $total_cart_price=0;
                                        $vat=0;
                                        $shipping_cost=0;
                                    @endphp
                                    @foreach ($monthly_total_sales as $monthly_sale)
                                        @php
                                            if($monthly_sale->flashdeal_id!=NULL)
                                            {
                                                $flash_product=App\Models\Flashdeal::find($monthly_sale->flashdeal_id);
                                                $discount=$monthly_sale->product->unit_price*($flash_product->discount/100);
                                            }else
                                            {
                                                $discount=$monthly_sale->product->discount;
                                            }
                                            $total_price=$monthly_sale->product->unit_price-$discount;
                                            $total_cart_price=round($total_cart_price+($total_price*$monthly_sale->product_quentity));
                                            $tax= $monthly_sale->product->vat;
                                            $vat=$vat+($total_price*($tax/100)*$monthly_sale->product_quentity);

                                            $checkout=App\Models\Checkout::where('cart_details',$monthly_sale->id)->first();
                                            
                                            if($checkout->shipping_area==1)
                                            {
                                                $shipping_cost=20+$shipping_cost+$monthly_sale->product->shipping_cost*$monthly_sale->product_quentity;
                                            }else{
                                                $shipping_cost=$shipping_cost+$monthly_sale->product->shipping_cost*$monthly_sale->product_quentity;
                                            }

                                            $monthly_sub_total_profit=$total_cart_price+$vat+$shipping_cost;
                                        @endphp
                                    @endforeach
                                    <h3 class="m-0">TK. {{ceil($monthly_sub_total_profit)}}</h3>
                                </div>
                                {{-- <div>
                                    <ul>
                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                        <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                        <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div style="display: none" class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order Summary</h4>
                            <div id="morris-bar-chart"></div>
                        </div>
                    </div>
                </div>    
                <div class="col-lg-12 col-md-12">
                    <div class="card card-widget">
                        <div class="card-body">
                            <h5 class="text-muted">Order Overview </h5>
                            <h2 class="mt-4">TK. {{ceil($sub_total_profit)}}</h2>
                            <span>Total Earnings</span>
                            <div class="mt-4">
                                @php
                                    $cash_total=0;
                                    $checkout_total=0;
                                    $online_total=0;
                                @endphp
                                @foreach ($checkouts as $checkout)
                                    @if ($checkout->payment_method==1)
                                       @php
                                            $cash_total++;
                                       @endphp
                                    @else
                                        @php
                                            $online_total++;
                                        @endphp
                                    @endif
                                    @php
                                        $checkout_total++;
                                    @endphp
                                @endforeach
                                @php
                                    
                                @endphp
                                <h4>{{$$online_total=$online_total!=0 ? $online_total:"0" }}</h4>
                                @if ($online_total!=0)
                                    <h6>Online Order <span class="pull-right">{{$online_total*(100/$checkout_total)}}%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar bg-primary" style="width: {{$online_total*(100/$checkout_total)}}%;" role="progressbar"><span class="sr-only">{{$online_total*(100/$checkout_total)}}% Order</span>
                                        </div>
                                    </div>
                                @else
                                    <h6>Online Order <span class="pull-right">0%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar bg-primary" style="width: 0%;" role="progressbar"><span class="sr-only">0% Order</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <h4>{{$cash_total=$cash_total!=0 ? $cash_total :"0"}}</h4>
                                @if ($cash_total!=0)
                                    <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">{{$cash_total*(100/$checkout_total)}}%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar bg-warning" style="width: {{$cash_total*(100/$checkout_total)}}%;" role="progressbar"><span class="sr-only">{{$cash_total*(100/$checkout_total)}}% Order</span>
                                        </div>
                                    </div>
                                @else
                                    <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">0%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar bg-warning" style="width: 0px;" role="progressbar"><span class="sr-only">0% Order</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        
        <div class="row">
            @foreach ($customers as $customer)
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/users/1.jpg')}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$customer->name}}</h5>
                            <p class="m-0">Admin</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/users/2.jpg')}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$customer->name}}</h5>
                            <p class="m-0">Admin</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/users/3.jpg')}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$customer->name}}</h5>
                            <p class="m-0">Admin</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset('assets/images/users/4.jpg')}}" class="rounded-circle" alt="">
                            <h5 class="mt-3 mb-1">{{$customer->name}}</h5>
                            <p class="m-0">Admin</p>
                            <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="active-member">
                            <div class="table-responsive">
                                <table class="table table-xs mb-0">
                                    <thead>
                                        <tr>
                                            <th>Customers</th>
                                            <th>Order Code</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($most_reccent_checkouts as $checkout)
                                            <tr id="exit_loop">
                                                <td><img src="{{asset('assets/images/profile/'.$checkout->supplier->image)}}" class=" rounded-circle mr-3" alt="">{{$checkout->supplier->name}}</td>
                                                <td>{{$checkout->order_code}}</td>
                                                <td>
                                                    <span>{{$checkout->supplier->phone}}</span>
                                                </td>
                                                <td>
                                                    @if ($checkout->is_paid==0)
                                                        <div>
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($checkout->is_paid==1)
                                                        <i class="fa fa-circle-o text-success  mr-2"></i> Paid
                                                    @else
                                                        <i class="fa fa-circle-o text-warning  mr-2"></i> Pending
                                                    @endif
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

        <div style="display: none" class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @for ($i = 0; $i <$count_yearly_total_order; $i++)
                                        <tr class="yearly_sale">
                                            <td>{{$yearly_total_order[$i]->month}}</td>
                                            <td>{{$yearly_total_order[$i]->count}}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="chart-wrapper mb-4">
                        <div class="px-4 pt-4 d-flex justify-content-between">
                            <div>
                                <h4>Total Order</h4>
                                <p>Current Year</p>
                            </div>
                        </div>
                        <div>
                                <canvas id="chart_widget_3"></canvas>
                        </div>
                    </div>
                    <div class="card-body border-top pt-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li style="display: none"  id="positive_feedback">{{$positive_rating_percent}}</li>
                                    <li style="display: none" id="negative_feedback">{{$negative_rating_percent}}</li>
                                    <li>{{$negative_rating_percent}} % Negative Feedback</li>
                                    <li >{{$positive_rating_percent}} % Positive Feedback</li>
                                </ul>
                                <div>
                                    <h5>Customer Feedback</h5>
                                    <h3>{{$total_review}}</h3>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="chart_widget_3_1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-sm-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                            <h4 class="card-title mb-0">Store Location</h4>
                        <div id="world-map" style="height: 470px;"></div>
                    </div>        
                </div>
            </div>
        </div>

        

        <div style="display: none" class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-facebook">
                            <span class="s-icon"><i class="fa fa-facebook"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">89k</h4>
                                    <p class="m-0">Friends</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">119k</h4>
                                    <p class="m-0">Followers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-linkedin">
                            <span class="s-icon"><i class="fa fa-linkedin"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">89k</h4>
                                    <p class="m-0">Friends</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">119k</h4>
                                    <p class="m-0">Followers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-googleplus">
                            <span class="s-icon"><i class="fa fa-google-plus"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">89k</h4>
                                    <p class="m-0">Friends</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">119k</h4>
                                    <p class="m-0">Followers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-twitter">
                            <span class="s-icon"><i class="fa fa-twitter"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">89k</h4>
                                    <p class="m-0">Friends</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <h4 class="m-1">119k</h4>
                                    <p class="m-0">Followers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- #/ container -->
</div>
@endsection