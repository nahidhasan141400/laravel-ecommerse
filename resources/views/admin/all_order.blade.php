@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
         <!-- Modal staff active  -->
    <div class="modal fade none-border" id="order_action_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="order_action_delete_submit">
                            @csrf
                            <div class="row">
                                <input style="display: none" type="text" id="ed_id" name="e_id"/>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <button id="brand_submit" type="submit" class="btn btn-primary">Delete</button>
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Orders</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Date</th>
                                    <th>Order Code</th>
                                    <th>Num. of Products</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Delevery Status</th>
                                    <th>Payment Status</th>
                                    <th>Pick Up Point</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                <tr>
                                    <td style="display: none">{{$sale->id}}</td>
                                    <td>{{$sale->created_at->toDateString()}}</td>
                                    
                                    <td>
                                        {{$sale->order_code}}
                                        @if ($sale->notify==0)
                                            <span class="badge gradient-1 badge-pill badge-primary">New</span>
                                        @endif
                                    </td>
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
                                    <td>{{$sale->supplier->name}}</td>
                                    <td>TK {{round($total_cart_price+$vat+$shipping_cost)}}.00</td>
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
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($sale->id);
                                            $order_code=Crypt::encrypt($sale->order_code);
                                        @endphp
                                        <span class="active">
                                            <a href="{{route('pdf_download',[$parameter,$order_code])}}"  class="{{$parameter}}" id="invoice_download" data-toggle="tooltip" data-placement="top" title="download invoice">
                                                <i class="fa fa-download color-muted m-r-5" aria-hidden="true"></i>  
                                            </a>
                                        </span>
                                        <span class="edit">
                                            <a href="{{route('order_details',$order_code)}}"  data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="view">
                                                    <i class="fa fa-eye color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span class="delete">
                                            <a  class="{{$parameter}}" id="order_delete" data-toggle="tooltip" data-placement="top" title="delete">
                                                    <i class="fa fa-trash-o color-muted m-r-5"></i> 
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