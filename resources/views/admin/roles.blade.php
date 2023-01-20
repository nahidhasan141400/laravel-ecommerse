@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 mb-3">
            <a href="{{route('create_role')}}"  class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create role</a>
        </div>

          <!-- Modal role delete product -->
      <div class="modal fade none-border" id="role_action_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="role_action_delete_submit">
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Orders</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td style="display: none">{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td style="float: right">
                                        <span class="edit">
                                            <a href="{{route('edit_role',$role->id)}}"   data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        
                                        <span class="delete">
                                            <a  class="{{$role->id}}" id="role_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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