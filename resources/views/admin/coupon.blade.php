@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 mb-3">
            <a href="{{route('coupon_create')}}"  class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Add New Coupon</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Coupon Information</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td style="display: none">{{$coupon->id}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->type==1?"For Products":"For Total Orders"}}</td>
                                    <td>{{$coupon->start_date}}</td>
                                    <td>{{$coupon->end_date}}</td>
                                    <td>
                                        <span style="float: right" class="delete">
                                            <a href="{{route('coupon_delete',$coupon->id)}}"  data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash-o color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection