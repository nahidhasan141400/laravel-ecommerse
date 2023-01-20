@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="#" data-toggle="modal" data-target="#usefullink_create_action" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
        </div>
    </div>
       <!-- Modal Edit staff -->
       <div class="modal fade none-border" id="usefullink_create_action">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Create useful link</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="post"  enctype="multipart/form-data" id="usefullink_create_action_submit">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="staff_name">Name
                                    </label>
                                    <div >
                                        <input style="display: none" type="text" class="form-control"  id="usefullink_id" name="usefullink_id" placeholder="Enter a name.." value="">   
                                        <input type="text" class="form-control"  id="usefullink_name" name="usefullink_name" placeholder="Enter a name.." value="">   
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="staff_phone">Link
                                    </label>
                                    <div >
                                        <input type="text" class="form-control"  id="usefullink_link" name="usefullink_link" placeholder="Enter a link.." value="">   
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

    <!-- Modal Edit staff -->
    <div class="modal fade none-border" id="usefullink_edit_action">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Edit useful link</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="post"  id="usefullink_edit_action_submit">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="usefullink_edit_name">Name
                                    </label>
                                    <div >
                                        <input style="display: none" type="text" class="form-control"  id="usefullink_edit_id" name="usefullink_edit_id" placeholder="Enter a name.." value="">   
                                        <input type="text" class="form-control"  id="usefullink_edit_name" name="usefullink_edit_name" placeholder="Enter a name.." value="">   
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="usefullink_edit_link">Link
                                    </label>
                                    <div >
                                        <input type="text" class="form-control"  id="usefullink_edit_link" name="usefullink_edit_link" placeholder="Enter a link.." value="">   
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
    <div class="modal fade none-border" id="usefullink_delete_action">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="usefullink_delete_action_submit">
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
                    <h4 class="card-title">Useful Link</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $link)
                                    <tr>
                                        <td style="display: none">{{$link->id}}</td>
                                        <td>{{$link->name}}</td>
                                        <td>{{$link->link}}</td>
                                        <td>
                                            @php
                                                $parameter= Crypt::encrypt($link->id);
                                            @endphp
                                            <span class="edit">
                                                <a class="{{$parameter}}"  id="usefullink_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="edit">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i> 
                                                </a>
                                            </span>
                                            <span class="delete">
                                                <a  class="{{$parameter}}" id="usefullink_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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