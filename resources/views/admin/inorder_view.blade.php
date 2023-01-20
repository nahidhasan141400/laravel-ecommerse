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
                    <h4 class="card-title">Order Details</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Order By</th>
                                    <th>Num. of Products</th>
                                    <th>Id No.</th>
                                    <th>Comment</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($inorders as $inorder)
                                <tr>
                                    <td style="display: none">{{$inorder->id}}</td>
                                    <td>{{$inorder->orderBy}}</td>
                                    <td>{{$inorder->quantity}}</td>
                                    <td>{{$inorder->id_no}}</td>
                                    <td>{{$inorder->comment}}</td>
                                    <td>{{$inorder->created_at->toDateString()}}</td>
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