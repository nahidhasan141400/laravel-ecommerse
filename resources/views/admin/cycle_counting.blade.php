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
                    <h4 class="card-title">Cycle Counting</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Product Name</th>
                                    <th>Available quantity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td style="display: none">{{$product->id}}</td>
                                        <td>{{$product->product->name}}</td>
                                        @php
                                            $quentity=$product->product->quentity-$product->product_quentity;
                                        @endphp
                                        <td>{{$quentity}}</td>
                                        <td>{{$product->updated_at->toDateString()}}</td>
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