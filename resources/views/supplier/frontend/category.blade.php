@extends('supplier.frontend.app')
@section('content')
<section class="collection_2 category_collection">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                <h1>{{$seo->name}}</h1>
                <hr/>
            </div>
            @foreach ($category as $sub_category)
                <div class="colum-33 alignment_center">
                    <a href="{{route('sub_category',[$sub_category->id,$seo->first_category_slug,$sub_category->first_category_slug])}}">
                        <img src="{{asset('mehromah/public/assets/images/category/'.$sub_category->logo)}}">
                        <!--<img src="{{asset('assets/images/category/'.$sub_category->logo)}}">-->
                    </a>
                    <p><a href="{{route('sub_category',[$sub_category->id,$seo->first_category_slug,$sub_category->first_category_slug])}}">{{$sub_category->name}}</a></p>
                </div>
            @endforeach
                <div class="colum-100">
                    <div class="view_more_p">
                        {!! $category->links() !!}
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection