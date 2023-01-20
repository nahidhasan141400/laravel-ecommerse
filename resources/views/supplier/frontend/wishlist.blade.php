@extends('supplier.frontend.app')
@section('content')
<section class="collection_2 category_collection">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                <h1>Wishlist</h1>
                <hr/>
            </div>
            @foreach (App\Models\Wishlist::totalWishlist() as $item)
                <div class="colum-33 alignment_center">
                    <a href="{{route('product_view',[$item->product_id,$item->product->slug])}}">
                        <!--<img src="{{asset('assets/images/product/'.$item->image)}}">-->
                        <img src="{{asset('mehromah/public/assets/images/product/'.$item->image)}}">
                    </a>
                    <p><a href="{{route('product_view',[$item->product_id,$item->product->slug])}}">{{$item->name}}</a></p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection