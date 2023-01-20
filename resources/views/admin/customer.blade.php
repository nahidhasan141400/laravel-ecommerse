@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
    <div class="row">
         <!-- Modal active product -->
         <div class="modal fade none-border" id="supplier_action_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="supplier_action_delete_submit">
                                @csrf
                                <div class="row">
                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <button id="brand_submit" type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Customer List</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($customers as $customer)
                                <tr>
                                    <td style="display: none">{{$customer->id}}</td>
                                    <td>
                                        {{$customer->name}}
                                        @if($customer->apply==2)
                                            <span class="badge gradient-1 badge-pill badge-primary">Applied for B2B</span>
                                        @endif
                                    </td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>
                                        @if ($customer->apply==0)
                                        B2C
                                        @elseif($customer->apply==1)
                                        B2B
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($customer->id);
                                        @endphp
                                        <span class="edit">
                                            <a href="{{route('customer_details_view',$parameter)}}"  data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="view">
                                                    <i class="fa fa-eye color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span style="float: right" class="delete">
                                            <a class="{{$parameter}}" id="supplier_delete" data-toggle="tooltip" data-placement="top" title="Delete Supplier">
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