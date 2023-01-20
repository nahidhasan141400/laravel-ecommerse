@extends('admin.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                       
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 mb-3">
                        <a href="#" data-toggle="modal" data-target="#category" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create category</a>
                    </div>
                    <!-- Modal Add Category -->
                    <div class="modal fade none-border" id="category">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Add New Category</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="post"  enctype="multipart/form-data" id="category_submit">
                                            @csrf
                                            <div class="row">
                                                <div class=" col-md-12">
                                                    {{-- <p class="text-danger">If you insert data only in first category field then it will be your parent category otherwise it will be your child category and last category field will be parent category.</p> --}}
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="first_category">Category name
                                                    </label>
                                                    <div >
                                                        <input required type="text" class="form-control"  id="first_category" name="first_category" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="second_category">Category name 
                                                    </label>
                                                    <select name="second_category" id="second_category" class="form-control">
                                                        <option value="0">Please choose one...</option>
                                                        @foreach ($sub_category as $parent_category)
                                                            <option  value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="category_logo">Category Logo <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-error">
                                                        <input required type="file" class="form-control"  id="category_logo" name="category_logo">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="category_title">Category title
                                                    </label>
                                                    <div >
                                                        <input required type="text" class="form-control"  id="category_title" name="category_title" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="category_description">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        <textarea required class="form-control" id="category_description" name="category_description" rows="4" placeholder="What would you like to see?"></textarea>
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
                       <!-- Modal edit brand -->
                       <div class="modal fade none-border" id="edit-category">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Update Category</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="category_edit">
                                            @csrf
                                            <div class="row">
                                                <div class=" col-md-12">
                                                    {{-- <p class="text-danger">If you insert data only in first category field then it will be your parent category otherwise it will be your child category and last category field will be parent category.</p> --}}
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="efirst_category">Category name
                                                    </label>
                                                    <div >
                                                        <input style="display:none" type="text" class="form-control"  id="eid" name="id" placeholder="Enter a name.." value="">   
                                                        <input required type="text" class="form-control"  id="efirst_category" name="efirst_category" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="second_category">Category name 
                                                    </label>
                                                    <select required name="esecond_category" id="esecond_category" class="form-control">
                                                        <option value="0"></option>
                                                        <option value="0">Please choose parent category...</option>
                                                        @foreach ($sub_category as $parent_category)
                                                            <option  value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <img style="max-width: 100%;" src="" id="elogo" name="elogo"/>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="ecategory_logo">Category Logo <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="image-error">
                                                        <input required type="file" class="form-control"  id="ecategory_logo" name="ecategory_logo">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="ecategory_title">Category title
                                                    </label>
                                                    <div >
                                                        <input required type="text" class="form-control"  id="ecategory_title" name="ecategory_title" placeholder="Enter a name.." value="">   
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label" for="ecategory_description">Description <span class="text-danger">*</span>
                                                    </label>
                                                    <div>
                                                        <textarea required class="form-control" id="ecategory_description" name="ecategory_description" rows="4" placeholder="What would you like to see?"></textarea>
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
                     <div class="modal fade none-border" id="category_action_delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-validation">
                                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="category_action_delete_submit">
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
                <div class="modal fade none-border" id="category_action_active">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-validation">
                                    <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="category_action_active_submit">
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
                <div class="modal fade none-border" id="category_action_deactive">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-validation">
                                    <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="category_action_deactive_submit">
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
                                <h4 class="card-title">Categories</h4>
                                <div class="table-responsive">
                                    <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th  style="display:none" >Id</th>
                                                <th>Parent category</th>
                                                <th>Child category</th>
                                                <th>Logo</th>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $category)
                                            <tr>
                                                <td style="display:none">{{$category->id}}</td>
                                                @if ($category->parent_id!=NULL)
                                                    <td class="center">{{$category->parent->name}}</td>
                                                @else
                                                    <td class="center">{{$category->name}}</td>
                                                @endif
                                                @if ($category->parent_id!=NULL)
                                                    <td class="center">{{$category->name}}</td>
                                                @else
                                                    <td class="center">No Child Category</td>
                                                @endif
                                                <td style="width: 15%;"><img id="category_img{{$category->id}}" style="max-width: 100%;" src="{{asset('assets/images/category/'.$category->logo)}}" /></td>
                                                <td>{{$category->title}}</td>
                                                <td>{{$category->description}}</td>
                                                <td>{{$category->added_by}}</td>
                                                <td style="width: 11%">
                                                    <span class="edit">
                                                        <a class="{{$category->id}}" href="#" id="editcategoryshow" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                   
                                                    @if ($category->status==1)
                                                    <span class="active">
                                                        <a href="" class="{{$category->id}}" id="category_active" data-toggle="tooltip" data-placement="top" title="Active">
                                                                <i class="fa fa-check color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                    @else
                                                    <span class="deactive">
                                                        <a href="" class="{{$category->id}}" id="category_deactive" data-toggle="tooltip" data-placement="top" title="Deactive">
                                                                <i class="fa fa-ban color-muted m-r-5"></i> 
                                                        </a>
                                                    </span>
                                                    @endif
                                                    <span class="delete">
                                                        <a href="" class="{{$category->id}}" id="category_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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
       