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
                        <a href="#" data-toggle="modal" data-target="#add-blog" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
                    </div>
                    <!-- Modal Add Category -->
                    <div class="modal fade none-border" id="add-blog">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 900px">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Add Blog</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="post"  enctype="multipart/form-data" id="blog_submit_form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="logo">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-error">
                                                        <input type="file" class="form-control"  id="logo" name="logo">
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="name">Title <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input type="text" class="form-control"  id="title" name="title" placeholder="Enter a title..">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="address">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <textarea rows="3" class="form-control" id="description" name="description">
                                                                
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <button id="blog_submit" type="submit" class="btn btn-primary">Submit</button>
                                                   
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
                       <div class="modal fade none-border" id="edit-blog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Update Blog</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="blog_edit_submit">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input style="display:none" type="text" class="form-control"  id="eid" name="id" placeholder="Enter a name.." value="">   
                                                    <img style="max-width: 100%;" src="" id="elogo" name="elogo"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="elogoup">Image <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-uperror">
                                                        <input type="file" class="form-control"  id="elogoup" name="elogoup">
                                                    </div>  
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="name">Title <span class="text-danger">*</span>
                                                    </label>
                                                    <div >
                                                        <input type="text" class="form-control"  id="etitle" name="etitle" placeholder="Enter a title.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="edescription">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        <textarea class="form-control" id="edescription" name="edescription" rows="3" placeholder="What would you like to see?"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <button id="blog_submit" type="submit" class="btn btn-primary">Update</button>
                                                   
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
                     <div class="modal fade none-border" id="blog_action_delete">
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
                <div class="modal fade none-border" id="blog_action_active">
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
                <div class="modal fade none-border" id="blog_action_deactive">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-validation">
                                    <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="blog_action_delete_submit">
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
                                <h4 class="card-title">Brands</h4>
                                <div class="table-responsive">
                                    <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th  style="display:none" >Id</th>
                                                <th>Logo</th>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $blog)
                                            <tr>
                                                <td style="display:none">{{$blog->id}}</td>
                                                <td style="width: 15%;"><img id="blog_img{{$blog->id}}" style="max-width: 100%;" src="{{asset('assets/frontend/image/blog/'.$blog->image)}}" /></td>
                                                <td>{{$blog->title}}</td>
                                                <td>{{$blog->description}}</td>
                                                <td>{{$blog->added_by}}</td>
                                                <td>
                                                    @php
                                                        $parameter= Crypt::encrypt($blog->id);
                                                    @endphp
                                                    <span class="edit">
                                                        <a href="#" class="{{$parameter}}" id="blog_show" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                   
                                                    <span class="delete">
                                                        <a href="" class="{{$parameter}}" id="blog_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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
       