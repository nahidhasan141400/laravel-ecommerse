@extends('supplier.frontend.app')
@section('content')
<section class="collection_2 about_collection">
    <div class="container">
        <div class="row">
            {{-- <div class="colum-100">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><i class="fas fa-chevron-right"></i></li>
                    <li><a href="#">Home</a></li>
                    <li><i class="fas fa-chevron-right"></i></li>
                    <li><a href="#">Home</a></li>
                </ul>
            </div> --}}
            <div class="colum-100">
                <h1 style="text-transform: uppercase">{{str_replace('_', ' ', $policy->name)}}</h1>
                <hr/>
            </div>
            <div class="colum-100 about_us alignment_center">
                <p>{!! $policy->content !!}</p>
            </div>
        </div>
    </div>
</section>

{{-- <div class="container">
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a>Policy</a></li>
        <li><a>{{str_replace('_', ' ', $policy->name)}}</a></li>
    </ul>
</div>
<div class="container col-2">
    <div class="row">
        <div style="float: right" id="content" class="col-sm-9">
            <h1>{{str_replace('_', ' ', $policy->name)}}</h1>
            <p>{!! $policy->content !!}</p>
        </div>  --}}
@endsection