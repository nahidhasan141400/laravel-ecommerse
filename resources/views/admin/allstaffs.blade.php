@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
  
    </div>
       <!-- Modal Edit staff -->
       <div class="modal fade none-border" id="staff_edit_action">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Staff Infofrmation</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="post"  enctype="multipart/form-data" id="staff_edit_action_submit">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="staff_name">Name
                                    </label>
                                    <div >
                                        <input style="display: none" type="text" class="form-control"  id="staff_edit_id" name="staff_name" placeholder="Enter a name.." value="">   
                                        <input type="text" class="form-control"  id="staff_name" name="staff_name" placeholder="Enter a name.." value="">   
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="staff_email">Email
                                    </label>
                                    <div >
                                        <input type="email" class="form-control"  id="staff_email" name="staff_email" placeholder="Enter a email.." value="">   
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="staff_phone">Phone
                                    </label>
                                    <div >
                                        <input type="text" class="form-control"  id="staff_phone" name="staff_phone" placeholder="Enter a email.." value="">   
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="staff_role">Staff role 
                                    </label>
                                    <select name="staff_role" id="staff_role" class="form-control">
                                        <option  value="1">Hello</option>
                                        <option id="staff_role_show" value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="staff_password">Phone
                                    </label>
                                    <div >
                                        <input type="text" class="form-control"  id="staff_password" name="staff_password" placeholder="Enter a password.." value="">   
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
     <!-- Modal staff active  -->
     <div class="modal fade none-border" id="staff_action_active">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="staff_action_active_submit">
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
    {{-- End --}}
     <!-- Modal staff active  -->
     <div class="modal fade none-border" id="staff_action_deactive">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="staff_action_deactive_submit">
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
    {{-- End --}}
    <!-- Modal staff active  -->
    <div class="modal fade none-border" id="staff_action_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="staff_action_delete_submit">
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
    {{-- End --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Staffs</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($staffs as $staff)
                                <tr>
                                    <td style="display: none">{{$staff->id}}</td>
                                    <td>{{$staff->name}}</td>
                                    <td>{{$staff->email}}</td>
                                    <td>{{$staff->phone}}</td>
                                    <td>{{$staff->role}}</td>
                                    <td>
                                        <span class="edit">
                                            <a class="{{$staff->id}}"  id="staff_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @if ($staff->status==1)
                                        <span class="active">
                                            <a  class="{{$staff->id}}" id="staff_active" data-toggle="tooltip" data-placement="top" title="Active">
                                                    <i class="fa fa-check color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a class="{{$staff->id}}" id="staff_deactive" data-toggle="tooltip" data-placement="top" title="Deactive">
                                                    <i class="fa fa-ban color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @endif
                                        <span class="delete">
                                            <a  class="{{$staff->id}}" id="staff_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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