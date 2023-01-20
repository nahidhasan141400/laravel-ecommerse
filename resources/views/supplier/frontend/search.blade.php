@extends('supplier.frontend.app')
@section('content')
<section class="collection_2 category_collection">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                
            </div>
            @foreach ($search as $item)
                <div class="colum-33 alignment_center">
                    <a href="{{route('product_view',[$item->id,$item->slug])}}">
                        <!--<img src="{{asset('assets/images/product/'.$item->productimage->image)}}">-->
                        <img src="{{asset('mehromah/public/assets/images/product/'.$item->productimage->image)}}">
                    </a>
                    <p><a href="{{route('product_view',[$item->id,$item->slug])}}">Bindas</a></p>
                </div>
            @endforeach
                <div class="colum-100">
                    <div class="view_more_p">
                        {!! $search->links() !!}
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection