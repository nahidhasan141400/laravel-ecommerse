@extends('supplier.frontend.app')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Comparison</a></li>
    </ul>
</div>
<div class="container">
    <div class="row">
        <div style="float: right" id="content" class="col-sm-9">
          @php
              $product_compare_quentity=0;
          @endphp
          @foreach (App\Models\Compare::totalCompare() as $item)
             @php
                  $product_compare_quentity++;
             @endphp
          @endforeach
            <h1>Comparison &nbsp;({{$product_compare_quentity}}) </h1>
              @php
                  $discount=0;
              @endphp
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td class="text-center">Image</td>
                      <td class="text-left">Product Name</td>
                      <td class="text-left">Size</td>
                      <td class="text-left">Color</td>
                      <td class="text-left">Brand</td>
                      <td class="text-left">Price</td>
                      <td class="text-left">Discount</td>
                      <td class="text-left">Add to Cart</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (App\Models\Compare::totalCompare() as $item)
                      <tr>
                        <td style="width: 10%;height:auto" class="text-center"><a href="product.html"><img style="width: 100%;height:auto" class="img-thumbnail" title="iPhone" alt="iPhone" src="{{asset('assets/images/product/'.$item->image)}}"></a></td>
                        <td class="text-left"><a href="product.html">{{$item->product->name}}</a></td>
                        <td class="text-left">product 11</td>
                        <td class="text-left">product 11</td>
                        <td class="text-left">{{$item->product->productbrand->name}}</td>
                        <td class="text-left">{{$item->product->unit_price}}</td>
                        <td class="text-left">{{$item->product->discount}} TK.</td>
                        <td class="text-left">
                            <div style="max-width: 200px;" class="input-group btn-block">
                                <span class="input-group-btn">
                                    <button onclick="addToCart({{$item->product_id}})" class="btn btn-primary" title="" data-toggle="tooltip" type="submit" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                                </span>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            
            <br>
            <div class="buttons">
            <div class="pull-left"><a class="btn btn-default" href="{{route('home')}}">Continue Shopping</a></div>
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
@endsection