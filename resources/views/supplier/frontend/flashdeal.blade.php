@extends('supplier.frontend.app')
@section('content')




<section class="collection_2 category_collection">
    <div class="container">
        <div class="row">
            <div class="colum-100">
                <h1>{{!empty($time)?$time->title:""}}</h1>
                <h2  id="demo" class="category-title"></h2>
                <hr/>
            </div>
            @if (!empty($flashdeal))
                @foreach ($flashdeal as $flashdeal)
                    @php
                        $product=App\Models\Product::find($flashdeal->product_id);
                    @endphp
                    <div class="colum-33 alignment_center">
                        <a href="{{route('flashdeal_product_view',[$product->id,$flashdeal->code])}}">
                            <img src="{{asset('assets/images/product/'.$product->flash_deal_image)}}">
                        </a>
                        <p><a href="{{route('flashdeal_product_view',[$product->id,$flashdeal->code])}}">{{$product->name}}</a></p>
                    </div>
                @endforeach
            @endif
                <div class="colum-100">
                    <div class="view_more_p">
                       
                    </div>
                </div>
        </div>
    </div>
</section>


<script>
        var last_date="<?php echo !empty($time)?$time->end:"11-11-1990"; ?>";
        var countDownDate = new Date(last_date).getTime();
        var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
        if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
@endsection