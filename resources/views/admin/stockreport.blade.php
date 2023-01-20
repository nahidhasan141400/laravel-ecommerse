@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product stock report</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Product Name</th>
                                    <th>Available Quantity</th>
                                    <th>Current Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td style="display: none">{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->current_stock}}</td>
                                        <td>{{$product->current_location}}</td>
                                        <td>
                                            @if ($product->current_stock<=$product->finish_alert && $product->current_stock>=1)
                                            <span class="view">
                                                    <a href=""   data-toggle="tooltip" data-placement="top" title="Pending">
                                                        <i class="btn" style="background: orange;color:#fff">Stock Low</i>
                                                    </a>
                                                </span> 
                                            @elseif($product->current_stock==0)
                                                <span class="view">
                                                    <a href=""   data-toggle="tooltip" data-placement="top" title="Pending">
                                                        <i class="btn btn-danger">Stock Out</i>
                                                    </a>
                                                </span> 
                                            @else
                                                <span class="view">
                                                    <a href=""   data-toggle="tooltip" data-placement="top" title="On review">
                                                        <i class="btn btn-info">Stock Available</i>
                                                    </a>
                                                </span>
                                            @endif
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