<!DOCTYPE html>
<html>
<head>
	@php
		$general_setting=App\Models\Generalsetting::orderBy('id','desc')->first();
	@endphp
	<title>Mehromah</title>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<meta name="keyword" content="{{!empty($seo->keyword)?$seo->keyword:(!empty($seo->name)?$seo->name:(!empty($seo->tag)?$seo->tag:"Luxury Hut"))}}" />
	<meta name="description" content="{{!empty($seo->description)?$seo->description:(!empty($seo->meta_description)?$seo->meta_description:"Luxury Hut")}}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@if ($general_setting!=NULL)
		<link type="image/gif" sizes="16x16" href="{{asset('assets/images/setting/'.$general_setting->favicon)}}" rel="icon" />
	@endif
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link href="{{asset('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/mehromah/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/mehromah/css/responsive.css')}}">
</head>
<body style="background: url({{asset('assets/frontend/mehromah/img/bg.jpg')}});">
	<section>
		<header class="header">
			<div class="container">
				<div class="row">
					<nav>
						<div class="colum-20">
							<a href="{{route('home')}}"><img class="logo" src="{{asset('assets/images/setting/'.$general_setting->logo)}}"></a>
						</div>
						<div class="colum-80">
							<ul class="left">
								
								@php
									$top_categorries=App\Models\Category::where('status',1)->orderBy('name', 'desc')->where('parent_id',NULL)->get();
									$top_cat_count=0;
								@endphp
								@foreach ($top_categorries as $top_category)
									<li><a href="{{route('main_category',[$top_category->id,$top_category->first_category_slug])}}">{{$top_category->name}}</a></li>
								@endforeach
								<li><a href="{{Auth::guard('supplier')->check()!=false?route('supplier_dashboard'):route('supplier_register')}}">{{Auth::guard('supplier')->check()!=false?"Dashboard":"Register"}}</a></li>
                                <li><a href="{{Auth::guard('supplier')->check()!=false?route('supplier_logout'):route('supplier_login')}}">{{Auth::guard('supplier')->check()!=false?"Logout":"Login"}}</a></li>
								@php
									$flashdeal=App\Models\Flashdeal::orderBy('id','desc')->first();
								@endphp
								<li><a href="{{$flashdeal->url}}">FlashDeal</a></li>
							</ul>
							<ul class="right">
								<li>
									<select>
										<option selected>BDT</option>
										{{-- <option>PKR</option>
										<option>CAD</option>
										<option>AUD</option>
										<option>GBP</option>
										<option>EUR</option> --}}
									</select>
								</li>
								<li class="search"><a href="#"><i class="fas fa-search"></i></a></li>
								<li><a href="{{route('view_cart')}}"><i class="fas fa-cart-arrow-down"></i><span style="margin-left: 5px;" id="total_items">{{App\Models\Cart::totalIteams()}}</span></a></li>
								<li><a href="{{route('view_wishlist')}}"><i class="fa fa-heart"></i><span style="margin-left: 5px;" id="total_items">{{App\Models\Wishlist::totalWishlistIteams()}}</span></a></li>
								<li>
									<a href="#">
				                        <i class="fa fa-bars menu slide"></i>
				                    </a>
			                   </li>
							</ul>
							<ul class="left_responsive">
								<li><a href="category.html">About Us</a></li>
								@php
									$top_categorries=App\Models\Category::where('status',1)->orderBy('name', 'desc')->where('parent_id',NULL)->get();
									$top_cat_count=0;
								@endphp
								@foreach ($top_categorries as $top_category)
									<li><a href="{{route('main_category',[$top_category->id,$top_category->first_category_slug])}}">{{$top_category->name}}</a></li>
								@endforeach
								<li><a href="category.html">Contact Us</a></li>
								<li><a href="{{Auth::guard('supplier')->check()!=false?route('supplier_dashboard'):route('supplier_register')}}">{{Auth::guard('supplier')->check()!=false?"Dashboard":"Register"}}</a></li>
                                <li><a href="{{Auth::guard('supplier')->check()!=false?route('supplier_logout'):route('supplier_login')}}">{{Auth::guard('supplier')->check()!=false?"Logout":"Login"}}</a></li>
							</ul>
							<div class="row">
								<div class="colum-100 search_parent">
									<form class="search_form" action="{{route('search')}}" method="get">
										<input type="text" name="search"><button><i class="fas fa-search"></i></button>
									</form>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
@yield('content')
	<section class="footer">
		<div class="container">
			<div class="row">
				<div class="colum-50">
					<div class="footer_left">
						<p>Follow</p>
						<ul>
							@if ($general_setting!=NULL)
								<li><a target="blank" href="{{$general_setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
								<li><a target="blank" href="{{$general_setting->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
								<li><a target="blank" href="{{$general_setting->youtube}}"><i class="fab fa-youtube"></i></a></li>
								<li><a target="blank" href="{{$general_setting->instagram}}"><i class="fab fa-instagram"></i></a></li>
								<li><a target="blank" href="{{$general_setting->linkedin}}"><i class="fab fa-linkedin"></i></a></li>
							@endif
						</ul>
					</div>
				</div>
				<div class="colum-50">
					<div class="footer_right">
						<ul>
							<li><a href="{{route('policy','about_us')}}">ABOUT US</a></li>
							<li><a href="{{route('policy','size_guide')}}">SIZE GUIDE</a></li>
							<li><a href="{{route('policy','faq')}}">FAQs</a></li>
							<li><a href="{{route('policy','return_policy')}}">RETURN AND EXCHANGE POLICY</a></li>
							<li><a href="{{route('policy','terms_condition')}}">TERMS & CONDITION</a></li>
							<li><a href="{{route('policy','contact')}}">CONTACT US</a></li>
						</ul>
						<p>Subscribe to get the latest on sales, new releases and more…</p>
						<div class="row">
							<form method="post" action="{{route('subscribe')}}">
								@csrf
								<div class="colum-80">
									<input required type="email" name="email" placeholder="Email address">
								</div>
								<div class="colum-20">
									<button>Subscribe</button>
								</div>
								<p class="copyright">&copy; <script>document.write(new Date().getFullYear());</script> Meheroma Powered by DewanICT.</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<a target="blank" href="https://api.whatsapp.com/send/?phone=+8801971991994&text&app_absent=0" class="float" target="_blank">
		<i class="fab fa-whatsapp"></i>
	</a>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/2.2.3/jquery.elevatezoom.min.js"></script>
<script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/js/toastr.init.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/frontend/mehromah/js/main.js')}}"></script>
@include('message')
<script>
    function addToCart(product,code)
    {
		if (typeof code === "undefined") {
           
        }else{
            product=product+','+code
        }
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/cart/"+product;
        var a="";
        var quentity=$("#input-quantity").val();
        var data=$("#cart_form_submit").serialize();
		console.log(data)
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:data,
            processData:false,
            contentType:false,
            success:function(response){
     
                if(response.error=="ok")
                {
                    // window.location=response.url;
                }
				console.log(response.url);
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
                console.log(error);
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
</script>


<script>
	 $('#zoom_01').elevateZoom({
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750,
       });
    $(document).on("click",".view_image", function(e){
        var dataimg=$(this).closest('.thumbnail').find('.view_image').attr("src");
        $('#zoom_01').attr("src",dataimg);
		$('#zoom_01').elevateZoom({
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750,
        });
    }); 
</script>