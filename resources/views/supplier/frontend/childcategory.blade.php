@extends('supplier.frontend.app')
@section('content')
<section class="collection_2 category_collection">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                <h1>{{$seo->name}}</h1>
                <hr/>
            </div>
            @foreach ($childcategory as $item)
                <div class="colum-33 alignment_center">
                    <a href="{{route('product_view',[$item->id,$item->slug])}}">
                        <img src="{{asset('mehromah/public/assets/images/product/'.$item->productimage->image)}}">
                        <!--<img src="{{asset('assets/images/product/'.$item->productimage->image)}}">-->
                    </a>
                    <p><a href="{{route('product_view',[$item->id,$item->slug])}}">{{$item->name}}</a></p>
                </div>
            @endforeach
                <div class="colum-100">
                    <div class="view_more_p">
                        {!! $childcategory->links() !!}
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection