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
                    <h4 class="card-title">Product Wish Report</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Product Name</th>
                                    <th>Number of wish</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlists as $wishlist)
                                    <tr>
                                        <td style="display: none">{{$wishlist->id}}</td>
                                        <td>{{$wishlist->product->name}}</td>
                                        <td>{{$wishlist->product_quentity}}</td>
                                        
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