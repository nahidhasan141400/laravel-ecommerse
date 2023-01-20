@extends('admin.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            {{-- <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div> --}}
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
                    </div>
                    <!-- Modal Add Category -->
                    <div class="modal fade none-border" id="add-category">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Add a Brand</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="post"  enctype="multipart/form-data" id="brand_submit">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="name">Brand Name <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input type="text" class="form-control"  id="name" name="name" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="logo">Brand Logo <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-error">
                                                        <input type="file" class="form-control"  id="logo" name="logo">
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="name">Meta Title <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input required type="text" class="form-control"  id="title" name="title" placeholder="Enter a title..">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="address">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        <textarea required class="form-control" id="description" name="description" rows="4" placeholder="What would you like to see?"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <button id="brand_submit" type="submit" class="btn btn-primary">Submit</button>
                                                   
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
                       <!-- Modal edit brand -->
                       <div class="modal fade none-border" id="edit-brand">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Update Brand</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="brand_edit">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="ename">Brand Name <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input style="display:none" type="text" class="form-control"  id="eid" name="id" placeholder="Enter a name.." value="">   
                                                        <input required type="text" class="form-control"  id="ename" name="ename" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <img style="max-width: 100%;" src="" id="elogo" name="elogo"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="elogoup">Brand Logo <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-uperror">
                                                        <input type="file" class="form-control"  id="elogoup" name="elogoup">
                                                    </div>  
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="name">Meta Title <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input required type="text" class="form-control"  id="etitle" name="etitle" placeholder="Enter a title.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="edescription">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        <textarea required class="form-control" id="edescription" name="edescription" rows="3" placeholder="What would you like to see?"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <button id="brand_submit" type="submit" class="btn btn-primary">Update</button>
                                                   
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
                     <!-- Modal edit brand -->
                     <div class="modal fade none-border" id="brand_action_delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="brand_action_delete_submit">
                                            @csrf
                                            <div class="row">
                                                <input style="display: none" type="text" id="ed_id" name="e_id"/>
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
                <!-- Modal edit brand -->
                <div class="modal fade none-border" id="brand_action_active">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-validation">
                                    <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="brand_action_active_submit">
                                        @csrf
                                        <div class="row">
                                            <input style="display: none" type="text" id="ea_id" name="e_id"/>
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
                <!-- Modal edit brand -->
                <div class="modal fade none-border" id="brand_action_deactive">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-validation">
                                    <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="brand_action_deactive_submit">
                                        @csrf
                                        <div class="row">
                                            <input style="display: none" type="text" id="eda_id" name="e_id"/>
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Brands</h4>
                                <div class="table-responsive">
                                    <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th  style="display:none" >Id</th>
                                                <th>Name</th>
                                                <th>Logo</th>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($brands as $brand)
                                            <tr>
                                                <td style="display:none">{{ $brand->id }}</td>
                                                <td>{{ $brand->name }}</td>
                                                <td style="width: 15%;"><img id="brand_img{{$brand->id}}" style="max-width: 100%;" src="{{asset('assets/images/brand/'.$brand->logo)}}" /></td>
                                                {{-- <td>{{ $brand->logo }}</td> --}}
                                                <td>{{ $brand->title }}</td>
                                                <td>{{ $brand->description }}</td>
                                                <td>{{ $brand->added_by }}</td>
                                                <td>
                                                    <span class="edit">
                                                        <a href="#" id="editbrandshow" data-id="{{ $brand->id }}" data-title="{{ $brand->name }}"   data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                   
                                                    @if ($brand->status==1)
                                                    <span class="active">
                                                        <a href="" class="{{$brand->id}}" id="brand_active" data-toggle="tooltip" data-placement="top" title="Active">
                                                                <i class="fa fa-check color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                    @else
                                                    <span class="deactive">
                                                        <a href="" class="{{$brand->id}}" id="brand_deactive" data-toggle="tooltip" data-placement="top" title="Deactive">
                                                                <i class="fa fa-ban color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                    @endif
                                                    <span class="delete">
                                                        <a href="" class="{{$brand->id}}" id="brand_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
       