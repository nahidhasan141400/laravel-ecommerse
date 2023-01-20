@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="#" data-toggle="modal" data-target="#supplier_list" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
        </div>
         <!-- Modal Add Category -->
         <div class="modal fade none-border" id="supplier_list">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 900px">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Supplier</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide" method="post" enctype="multipart/form-data" id="supplier_list_submit">
                                @csrf
                                <div class="row">
                                    <div class=" col-md-12">
                                        {{-- <p class="text-danger">If you insert data only in first category field then it will be your parent category otherwise it will be your child category and last category field will be parent category.</p> --}}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Supplier Id
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="code" name="code" placeholder="Enter a id number.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Supplier Type
                                        </label>
                                        <select name="group" id="group" class="form-control" required>
                                            <option value="0">Choose type...</option>
                                            <option  value="1">Local</option>  
                                            <option  value="1">Foreign</option>    
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Supplier name
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="name" name="name" placeholder="Enter a name.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Phone
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="phone" name="phone" placeholder="Enter a phone number.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Email
                                        </label>
                                        <div >
                                            <input required type="email" class="form-control"  id="email" name="email" placeholder="Enter a email address.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_description">Address
                                        </label>
                                        <div>
                                            <textarea required class="form-control" id="address" name="address" rows="4" placeholder="What would you like to see?"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <button  type="submit" class="btn btn-primary">Submit</button>
                                       
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
         <div class="modal fade none-border" id="supplierlist_action_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="supplierlist_action_delete_submit">
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

         <!-- END MODAL -->
         <div class="modal fade none-border" id="supplierlist_action_active">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="supplierlist_action_active_submit">
                                @csrf
                                <div class="row">
                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <button id="brand_submit" type="submit" class="btn btn-primary">Active</button>
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

         <!-- END MODAL -->
         <div class="modal fade none-border" id="supplierlist_action_deactive">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="supplierlist_action_deactive_submit">
                                @csrf
                                <div class="row">
                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <button id="brand_submit" type="submit" class="btn btn-primary">Deactive</button>
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
                    <h4 class="card-title">Supplier List</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th  style="display:none" >Id</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Add date</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($supplierlists as $supplierlist)
                                <tr>
                                    <td style="display:none">{{$supplierlist->id}}</td>
                                    <td>{{$supplierlist->code}}</td>
                                    <td>{{$supplierlist->name}}</td>
                                    <td>{{$supplierlist->updated_at->toDateString()}}</td>
                                    <td>{{$supplierlist->address}}</td>
                                    <td>{{$supplierlist->phone}}</td>
                                    <td>{{$supplierlist->email}}</td>
                                    <td>
                                        @if ($supplierlist->group==1)
                                            Domestic
                                        @else
                                            Foreign
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($supplierlist->id);
                                        @endphp
                                        <span style="float: right" class="delete">
                                            <a href="" class="{{$parameter}}" id="supplierlist_delete" data-toggle="tooltip" data-placement="top" title="Delete Supplier">
                                                    <i class="fa fa-trash-o color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                       @if ($supplierlist->status==1)
                                        <span class="active">
                                            <a href="" class="{{$parameter}}" id="supplierlist_active" data-toggle="tooltip" data-placement="top" title="Featured product active">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$parameter}}" id="supplierlist_deactive" data-toggle="tooltip" data-placement="top" title="Featured product deactive">
                                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
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