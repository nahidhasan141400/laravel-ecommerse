@extends('supplier.frontend.app')
@section('content')




<section class="collection cart_collection">
    <div class="container">
        <div class="row">
            <div class="colum-50">
                <div class="row">
                    <div class="colum-100" style="margin-top: 75px;">
                        <a href="#"><img id="zoom_01" src="{{asset('assets/images/product/'.$product->flash_deal_image)}}"></a>
                    </div>
                    <div class="colum-100">
                        <div class="owl-carousel owl-theme owl-carousel_3">
                            @foreach ($product->productallimage as $product_image)
                                <div class="item">
                                    <a class="thumbnail"><img class="view_image" src="{{asset('assets/images/product/'.$product_image->image)}}"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="colum-50" style="margin-top: 35px;">
                <div class="row">
                    <div class="colum-100">
                        <h1>{{$product->name}}</h1>
                    </div>
                    <div class="colum-100">
                        <button><i class="fab fa-whatsapp"></i><a target="blank" style="color:#fff" href="https://api.whatsapp.com/send/?phone=+8801641769553&text&app_absent=0">Chat with fashion consultant</a></button>
                    </div>
                    <div class="colum-100">
                        <div class="row border_l_b">
                            <div class="colum-100">
                                <h2>{{$product->description}}</h2>
                            </div>
                            <div class="colum-100">
                                <p>{{$product->name}}</p>
                            </div>
                            @php
                                $flashdeal_products=explode(',',$flashdeal->product_id);
                                $flashdeal_product_discount=explode(',',$flashdeal->discount);
                            @endphp
                            @foreach (array_combine($flashdeal_products,$flashdeal_product_discount) as $flashdeal_product=>$flashdeal_product_discount)
                                @if ($product->id==$flashdeal_product)
                                    @php
                                        $flashdeal_discount=$flashdeal_product_discount;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $discount=$product->unit_price*($flashdeal_discount/100);
                                $total_price=$product->unit_price-$discount;
                            @endphp
                            <div class="colum-100">
                                <h1 class="amount">BDT:{{round($total_price)}}.00</h1>
                            </div>
                            <div class="colum-100">
                                <hr/>
                            </div>
                            <div class="colum-100">
                                <form method="POST" id="cart_form_submit">
                                    @csrf
                                    <div class="row">
                                        @php
                                            $customer_choice=unserialize($product->customer_choice);
                                        @endphp
                                        @if ($customer_choice)
                                            @foreach ($customer_choice as $key => $value)
                                                @php
                                                    $customer_choice_contents=explode(",",$value);
                                                @endphp
                                                 <div class="colum-100">
                                                    <p>{{$key}}</p>
                                                </div>
                                                <div class="colum-100">
                                                    <ul>
                                                        @foreach ($customer_choice_contents as $customer_choice_content)
                                                            <li>
                                                                <input class="radio"  id="{{$customer_choice_content}}" type="radio" name="{{$key}}" value="{{$customer_choice_content}}">
                                                                <label for="{{$customer_choice_content}}">{{$customer_choice_content}}</label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>   
                                            @endforeach
                                        @endif
                                        <div class="colum-100">
                                            <p><a href="">Size Guide</a></p>
                                        </div>
                                        <div class="colum-20">
                                            <div class="quantity">
                                                <span class="minus">-</span>
                                                    <input id="input-quantity" class="item_number" type="text" name="quantity" value="1">
                                                <span class="plus">+</span>
                                            </div>
                                        </div>
                                        <div class="colum-20 wishlist">
                                            <a href="#" onclick="addToWishlist({{$product->id}},{{$flashdeal->id}})">WISHLIST</a>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$product->id}}" />
                                        <div class="colum-30">
                                            <button onclick="addToCart({{$product->id}},{{$flashdeal->id}})" type="button" class="add_to_cart">ADD TO CART</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @php
                        $customer_choice=unserialize($product->customer_choice);
                    @endphp
                    @if ($customer_choice)
                        @foreach ($customer_choice as $key => $value)
                            @php
                                $customer_choice_contents=explode(",",$value);
                            @endphp
                            <div class="colum-100">
                                <h1>{{$key}}</h1>
                            </div>
                            <div class="colum-100">
                                <ul class="feature">
                                    @foreach ($customer_choice_contents as $customer_choice_content)
                                        <li>{{$customer_choice_content}}</li>
                                    @endforeach  
                                </ul>
                            </div> 
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="instagram_feed">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                <h1>Related Items</h1>
                <hr/>
            </div>
            <div class="colum-100">
                <div class="owl-carousel owl-theme owl-carousel_2">
                    @foreach ($related_product as $related_product)
                        <div class="item">
                            <a href="{{route('product_view',[$related_product->id,$related_product->slug])}}">
                                <img src="{{asset('assets/images/product/'.$related_product->productimage->image)}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

























        {{-- <script>
            function addToCart(product)
            {
                alert("data");

                var get_protocol=location.protocol;
                var get_host=location.host;
                var get_location=get_protocol+"//"+get_host+"/cart/"+product;
                var a="";
                var quentity=$("#input-quantity").val();
                var data=$("#cart_form_submit").serialize();

                

                $.ajax({
                    url:get_location,
                    dataType : 'json',
                    method:'GET',
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        $("#total_items").html(response.total_items);
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
                            tapToDismiss:!1
                        })


                    },
                    error:function(error){
                        alert("error");
                    }
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
        </script> --}}
@endsection