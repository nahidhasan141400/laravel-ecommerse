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
                    <h4 class="card-title">Wishlist</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th  style="display:none" >Id</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Previous Price</th>
                                    <th>Discount Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Wishlist::totalWishlist() as $item)
                                    @php
                                        $discount=$item->product->unit_price*($item->product->discount/100);
                                        $wishlist_total_price=$item->product->unit_price-$discount;
                                    @endphp
                                <tr>
                                    <td style="display:none"></td>
                                    <td>{{$item->product->name}}</td>
                                    <td style="width: 15%;"><img id="brand_img" style="width: 100%;"  src="{{asset('assets/images/product/'.$item->image)}}" /></td>
                                    <td>TK {{round($item->product->unit_price)}}.00</td>
                                    <td>TK {{round($wishlist_total_price)}}.00</td>
                                    <td>
                                        <span class="edit">
                                            <a class="" href="{{route('view_wishlist')}}" id="product_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="Add to cart">
                                                <i class="fa fa-shopping-basket"></i>
                                            </a>
                                        </span>
                                        <span class="delete">
                                            @php
                                                $parameter= Crypt::encrypt($item->id);
                                            @endphp
                                            <a href="{{route('delete_wishlist',$parameter)}}" class="" id="product_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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