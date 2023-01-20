@extends('supplier.frontend.app')
@section('content')
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="category.html">Desktops</a></li>
        <li><a href="#">iPod Classic</a></li>
    </ul>
</div>
<div class="container col-2">
    <div class="row">
        <div style="float: right" id="content" class="col-sm-9">
       
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