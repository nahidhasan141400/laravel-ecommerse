@extends('supplier.frontend.app')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Child Category</a></li>
        <li><a href="#">Sort</a></li>
    </ul>
</div>
<div class="container col-2">
    <div class="row">
        <div style="float: right" id="content" class="col-sm-9">
        
            <h2 class="category-title">Search</h2>
            <div class="category-page-wrapper">
                <div class="col-md-6 list-grid-wrapper">
                <div class="btn-group btn-list-grid">
                    <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                    <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                </div>
                <div class="col-md-2 text-right sort-wrapper">
                <label class="control-label" for="input-sort">Sort By:</label>
                <div class="sort-inner">
                    <form action="{{route('sub_category_sort',$query)}}">
                        <select name="filter" id="input-sort" class="form-control">
                            @if ($value==1)
                                <option selected="selected" value="1">Name (A - Z)</option>
                            @elseif($value==2)
                                <option selected="selected" value="2">Name (Z - A)</option>
                            @elseif($value==3)
                                <option selected="selected" value="3">Price (Low &gt; High)</option>
                            @elseif($value==4)
                                <option selected="selected" value="4">Price (High &gt; Low)</option>
                            @elseif($value==5)
                                <option selected="selected" value="5">Rating (Highest)</option>
                            @elseif($value==6)
                                <option selected="selected" value="6">Rating (Lowest)</option>
                            @else
                                <option value="0" selected="selected">Default</option>
                            @endif
                            <option value="1">Name (A - Z)</option>
                            <option value="2">Name (Z - A)</option>
                            <option value="3">Price (Low &gt; High)</option>
                            <option value="4">Price (High &gt; Low)</option>
                            <option value="5">Rating (Highest)</option>
                            <option value="6">Rating (Lowest)</option>
                        </select>
                        <button id="submit_search" style="display: none">ss</button>
                    </form>
                </div>
                </div>
            </div>
            <br />
            <div class="grid-list-wrapper">
                @foreach ($search as $item)
                <div class="product-layout product-list col-xs-12">
                    <div class="product-thumb">
                        <div class="image product-imageblock"> <a href="{{route('product_view',[$item->id,$item->slug])}}"> <img style="width:220px;height:294px" src="{{asset('assets/images/product/'.$item->productimage->image)}}" alt="iPod Classic" title="iPod Classic" class="img-responsive" /> </a>
                        <div class="button-group">
                            <button onclick="addToWishlist({{$item->id}})" type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                            <button onclick="addToCart({{$item->id}})" type="button" class="addtocart-btn">Add to Cart</button>
                            <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                        </div>
                        </div>
                        <div class="caption product-detail">
                        <h4 class="product-name"> <a href="product.html" title="iPod Classic"> {{$item->name}} </a> </h4>
                        <p class="product-desc">{{$item->description}}..</p>
                        @php
                            $discount=$item->discount;
                            $total_price=$item->unit_price-$discount;
                        @endphp
                        <p class="price product-price"><span class="price-old">TK {{ceil($item->unit_price)}}.00</span> TK {{ceil($total_price)}}.00</p>
                        <div class="rating">
                            @for ($i = 0; $i < $item->rating; $i++)
                                <span class="fa fa-stack">
                                    <i class="fa fa-star fa-stack-2x"></i>
                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                </span> 
                            @endfor
                            @for ($j = $i; $i < 5; $i++)
                                <span class="fa fa-stack">
                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                </span> 
                            @endfor
                        </div>
                        </div>
                        <div class="button-group">
                        <button onclick="addToWishlist({{$item->id}})" type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                        <button onclick="addToCart({{$item->id}})" type="button" class="addtocart-btn">Add to Cart</button>
                        <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="category-page-wrapper">
                <div class="result-inner">Showing 1 to {{$current_page}} of {{$search->lastPage()}} ({{$search->lastPage()}} Pages)</div>
                <div class="pagination-inner">
                <ul class="pagination">
                    <li class="active"><span>{!! $search->links() !!}</span></li>
                </ul>
                </div>
            </div>
        </div>
        <script>
            function addToCart(product)
            {
                var get_protocol=location.protocol;
                var get_host=location.host;
                var get_location=get_protocol+"//"+get_host+"/cart/"+product;
                var a="";
                $.get(get_location,
                function(data)
                {
                    data=JSON.parse(data);
                    if(data.status=='success')
                    {
                        $("#total_items").html(data.total_items);
                    }
                    var successMessage="Cart added successfully!";
                    toastr.success(successMessage,"Message",
                    {
                        timeOut:5e3,
                        closeButton:!0,
                        debug:!1,
                        newestOnTop:!0,
                        progressBar:!0,
                        positionClass:"toast-top-right",
                        preventDuplicates:!0,
                        onclick:null,
                        showDuration:"300",
                        hideDuration:"1000",
                        extendedTimeOut:"1000",
                        showEasing:"swing",
                        hideEasing:"linear",
                        showMethod:"fadeIn",
                        hideMethod:"fadeOut",
                        tapToDismiss:!1})
                });
            }
        </script>

        <script>
            function addToWishlist(product)
            {
                var get_protocol=location.protocol;
                var get_host=location.host;
                var get_location=get_protocol+"//"+get_host+"/wishlist/"+product;
                var a="";
                $.get(get_location,
                function(data)
                {
                    data=JSON.parse(data);
                    if(data.status=='success')
                    {
                        $("#total_wishlist").html(data.total_items);
                    }else{
                        alert("ok");
                    }
                    var successMessage="Wishlist added successfully!";
                    toastr.success(successMessage,"Message",
                    {
                        timeOut:5e3,
                        closeButton:!0,
                        debug:!1,
                        newestOnTop:!0,
                        progressBar:!0,
                        positionClass:"toast-top-right",
                        preventDuplicates:!0,
                        onclick:null,
                        showDuration:"300",
                        hideDuration:"1000",
                        extendedTimeOut:"1000",
                        showEasing:"swing",
                        hideEasing:"linear",
                        showMethod:"fadeIn",
                        hideMethod:"fadeOut",
                        tapToDismiss:!1})
                });
            }
        </script>
@endsection