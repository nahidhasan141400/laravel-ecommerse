@extends('supplier.frontend.app')
@section('content')
	    <div class="slider">
			<div class="row">
				<div class="colum-100">
					<div class="owl-carousel owl-theme">
						@foreach ($sliders as $slider)
							<div class="item">
							    <img src="{{asset('mehromah/public/assets/frontend/image/banners/'.$slider->photo)}}" alt="{{$slider->photo}}">
								<!--<img src="{{asset('assets/frontend/image/banners/'.$slider->photo)}}" alt="{{$slider->photo}}">-->
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="meheroma_description">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					<h1>Mehromah</h1>
					<hr/>
				</div>
				<div class="colum-100">
					<p>“Mehromah is an Persian Arabic word meaning sun and moon along with its ray, brightness, colour and beauty. All the meanings and synonyms of Sun and Moon the two beautiful creations of the Almighty are considered as essence of the concept of business of creative fashion brand titled Mehromah. Mehromah is a humble effort to explore the further beauties of the supreme living creation of the Almighty Allah i.e. Human. www.mehroma.com is mostly an online fashion store with limited number of physical stores. Mehromah is just trying to get a birth in this fashion industry and promises to foster creativity, genuineness and newness. Mehromah is for those who want and deserves something special and unique. Thus it is formulated as a Brand for the people who chose something special from the general and want to stand alone from the crowd. Here we are for them, we are for their dream to make true. Currently we are presenting a one-stop lifestyle platform, holding various products with promises of the grandest of online shopping experiences across the country. Mehromah provides specialty for all moments of life like casual, formal, occasional or very special mood of life. We believe life is not made up of only days but each day is a realm of life, where every moment is a different color and Mehromah will be interested for each and every colors of life. So, be with us, surf our special collection which is/are only made for your extra-ordinary outfit. We hope Mehromah will take the core place of your heart and mind where your choice of fashion starts ”</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div 
				class="attach_image" 
				style="background-image: url({{asset('assets/frontend/mehromah/img/mehromah-slider.jpg')}});">
			</div>
		</div>
	</section>
	<section class="collection">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					<h1><a href="">New Arrival</a></h1>
					<hr/>
				</div>
				@php
				 	$new_arrival=App\Models\Product::where('status',1)
										->orderBy('created_at', 'asc')
										->limit(8)
										->get();
				@endphp
				@foreach ($new_arrival as $new_arrival)
					<div class="colum-50 alignment_center">
						<a href="{{route('product_view',[$new_arrival->id,$new_arrival->slug])}}">
							<!--<img src="{{asset('assets/images/product/'.$new_arrival->productimage->image)}}">-->
							<img src="{{asset('mehromah/public/assets/images/product/'.$new_arrival->productimage->image)}}">
						</a>
						<p><a href="{{route('product_view',[$new_arrival->id,$new_arrival->slug])}}">{{$new_arrival->name}}</a></p>
					</div>
					
				@endforeach
				{{-- <div class="colum-100">
					@if (count(array($new_arrival))>0)
						<p class="view_more_p"><a class="view_more_a" href="">View More</a></p>
					@endif
				</div> --}}
			</div>
		</div>
	</section>
	<section class="collection">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					<h1><a href="">Most Selling Product</a></h1>
					<hr/>
				</div>
				@php
				 	$best_sell_product=App\Models\Product::where('status',1)
										->orderBy('num_of_sale', 'desc')
										->limit(8)
										->get();
				@endphp
				@foreach ($best_sell_product as $best_sell_product)
					<div class="colum-50 alignment_center">
						<a href="{{route('product_view',[$best_sell_product->id,$best_sell_product->slug])}}">
							<!--<img src="{{asset('assets/images/product/'.$best_sell_product->productimage->image)}}">-->
							<img src="{{asset('mehromah/public/assets/images/product/'.$best_sell_product->productimage->image)}}">
						</a>
						<p><a href="{{route('product_view',[$best_sell_product->id,$best_sell_product->slug])}}">{{$best_sell_product->name}}</a></p>
					</div>
					
				@endforeach
				{{-- <div class="colum-100">
					@if (count(array($best_sell_product))>0)
						<p class="view_more_p"><a class="view_more_a" href="">View More</a></p>
					@endif
				</div> --}}
			</div>
		</div>
	</section>
	<section class="collection">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					@php
						$categories=App\Models\Category::where('status',1)->where('parent_id',NULL)->orderBy('id','desc')->limit(1)->get();
					@endphp
					@foreach ($categories as $category)
					 	@if ($category->parent_id==NULL)
							<h1><a href="{{route('main_category',[$category->id,$category->first_category_slug])}}">{{ $category->name }}</a></h1>
					<hr/>
				</div>
							@php
								$sub_categories=App\Models\Category::where('status',1)->orderBy('id','desc')->where('parent_id',$category->id)->limit(8)->get();
							@endphp
							@foreach ($sub_categories as $sub_categorie)
								<div class="colum-50 alignment_center">
									<a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">
									    <!--<img src="{{asset('assets/images/category/'.$sub_categorie->logo)}}">-->
									    <img src="{{asset('mehromah/public/assets/images/category/'.$sub_categorie->logo)}}">
									    </a>
									<p><a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">{{ $sub_categorie->name }}</a></p>
								</div>
							@endforeach
						@endif
					@endforeach  
				<div class="colum-100">
					@if (count(array($category))>0)
						<p class="view_more_p"><a class="view_more_a" href="{{route('main_category',[$category->id,$category->first_category_slug])}}">View More</a></p>
					@endif
				</div>
			</div>
		</div>
	</section>
	<section class="collection_radius">
		<div class="container">
			<div class="row">
				@php
					$categories=App\Models\Category::where('status',1)->where('parent_id',NULL)->orderBy('id','desc')->limit(3)->get();
				@endphp
				@foreach ($categories as $category)
					@if ($category->parent_id==NULL)
					<div class="colum-33">
						<a href="{{route('main_category',[$category->id,$category->first_category_slug])}}">
						    <!--<img src="{{asset('assets/images/category/'.$category->logo)}}">-->
						    <img src="{{asset('mehromah/public/assets/images/category/'.$category->logo)}}">
						    </a>
						<p><a href="{{route('main_category',[$category->id,$category->first_category_slug])}}">{{ $category->name }}</a></p>
						<hr/>
					</div>
					@endif
				@endforeach 
			</div>
		</div>
	</section>
	<section class="collection">
		<div class="container">
			<div class="row">
			
					@php
						$categories=App\Models\Category::where('status',1)->where('parent_id',NULL)->orderBy('id','desc')->skip(1)->limit(3)->get();
					@endphp
					@foreach ($categories as $category)
						<div class="colum-100">
					 	@if ($category->parent_id==NULL)
							<h1><a href="{{route('main_category',[$category->id,$category->first_category_slug])}}">{{ $category->name }}</a></h1>
					<hr/>
				</div>
							@php
								$sub_categories=App\Models\Category::where('status',1)->orderBy('id','desc')->where('parent_id',$category->id)->limit(4)->get();
							@endphp
							@foreach ($sub_categories as $sub_categorie)
								<div class="colum-50 alignment_center">
									<a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">
									    <!--<img src="{{asset('assets/images/category/'.$sub_categorie->logo)}}">-->
									    <img src="{{asset('mehromah/public/assets/images/category/'.$sub_categorie->logo)}}">
									    </a>
									<p><a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">{{ $sub_categorie->name }}</a></p>
								</div>
							@endforeach
						@endif
					@endforeach  
				<div class="colum-100">
					@if (count(array($category))>0)
						<p class="view_more_p"><a class="view_more_a" href="{{route('main_category',[$category->id,$category->first_category_slug])}}">View More</a></p>
					@endif
					</div>
			</div>
		</div>
	</section>
	<section class="blog">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					@php
						$categories=App\Models\Category::where('status',1)->where('parent_id',NULL)->orderBy('id','desc')->skip(1)->limit(1)->get();
					@endphp
					@foreach ($categories as $category)
					 	@if ($category->parent_id==NULL)
							<h1><a href="{{route('main_category',[$category->id,$category->first_category_slug])}}">{{ $category->name }}</a></h1>
					<hr/>
				</div>
						@php
							$sub_categories=App\Models\Category::where('status',1)->orderBy('id','desc')->where('parent_id',$category->id)->limit(4)->get();
						@endphp
						@foreach ($sub_categories as $sub_categorie)
							<div class="colum-25 alignment_center">
								<a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">
								    <!--<img src="{{asset('assets/images/category/'.$sub_categorie->logo)}}">-->
								    <img src="{{asset('mehromah/public/assets/images/category/'.$sub_categorie->logo)}}">
								    </a>
								<p><a href="{{route('sub_category',[$sub_categorie->id,$category->first_category_slug,$sub_categorie->first_category_slug])}}">{{ $sub_categorie->name }}</a></p>
							</div>
						@endforeach
						@endif
					@endforeach  
				<div class="colum-100">
					@if (count(array($category))>0)
						<p class="view_more_p"><a class="view_more_a" href="{{route('main_category',[$category->id,$category->first_category_slug])}}">Read More</a></p>
					@endif
				</div>
			</div>
		</div>
	</section>
	<section class="video">
		<div class="row">
			<div class="colum-100">
				<iframe src="https://www.youtube.com/embed/WX88LCO8QbE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</section>
	<section class="instagram_feed">
		<div class="container">
			<div class="row">
				<div class="colum-100">
					<h1>Instagram feed</h1>
					<hr/>
				</div>
				<div class="colum-100">
					<div class="owl-carousel owl-theme owl-carousel_2">
						@foreach ($banners1 as $banner1)
							<div class="item">
								<a href="{{ $banner1->url}}">
								    <!--<img src="{{asset('assets/frontend/image/banners/'.$banner1->photo)}}">-->
								    <img src="{{asset('mehromah/public/assets/frontend/image/banners/'.$banner1->photo)}}">
								    </a>
								<p class="instagram_content">{{$banner1->description}}</p>
								<p class="instagram_date">{{$banner1->created_at}}</p>
							</div>
						@endforeach     
				    </div>
				</div>
			</div>
		</div>
    </section>
@endsection
	