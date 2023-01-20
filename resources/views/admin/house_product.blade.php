@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="#" data-toggle="modal" data-target="#add-product" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
        </div>
        @if ($errors)
            <div>
        @else
            <div style="display: none">
        @endif
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_name')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_title')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_description')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_quentity')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_category')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_child_category')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_brand')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_meta_tag')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_unit_price')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_purchase_price')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('tax')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_meta_title')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('product_meta_description')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('uploaded_image_name')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('featured_product')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('special_product')}}</div>
            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('flash_deal')}}</div>
        </div>
        <!<!-- Modal Add Category -->
        <div class="modal fade none-border" id="add-product">
            <div class="modal-dialog">
                <div class="modal-content" style="width:178%">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Product</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="post"  enctype="multipart/form-data" id="inproduct_submit">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="name">Name <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input type="text" class="form-control"  id="name" name="name" placeholder="Enter a name.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="logo">Image <span class="text-danger">*</span>
                                        </label>
                                        <div id="image-error">
                                            <input type="file" class="form-control"  id="logo" name="logo">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="current_location">Current Location <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="current_location" name="current_location" placeholder="Product location..">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Quantity <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input required type="number" class="form-control"  id="quentity" name="quentity" placeholder="Product quantity....">   
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

        <!<!-- Modal Add Category -->
        <div class="modal fade none-border" id="edit-inproduct">
            <div class="modal-dialog">
                <div class="modal-content" style="width:178%">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Edit Product</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="post"  enctype="multipart/form-data" id="inproduct_edit_submit">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label" for="name">Name <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input style="display: none" type="text" class="form-control"  id="eid" name="eid" placeholder="Enter a name.." value="">   
                                            <input type="text" class="form-control"  id="ename" name="name" placeholder="Enter a name.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <img style="max-width: 100%;" src="" id="elogo" name="elogo"/>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="col-form-label" for="logo">Image <span class="text-danger">*</span>
                                        </label>
                                        <div id="image-error">
                                            <input type="file" class="form-control"  id="enlogo" name="logo">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="current_location">Current Location <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="ecurrent_location" name="current_location" placeholder="Product location..">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Quantity <span class="text-danger">*</span>
                                        </label>
                                        <div >
                                            <input required type="number" class="form-control"  id="equentity" name="quentity" placeholder="Product quantity....">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Order Quantity 
                                        </label>
                                        <div >
                                            <input  type="number" class="form-control"  id="order_quentity" name="quentity" placeholder="Product quantity....">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Order By 
                                        </label>
                                        <div >
                                            <input  type="text" class="form-control"  id="order_by" name="quentity" placeholder="Name....">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Id No. 
                                        </label>
                                        <div >
                                            <input  type="text" class="form-control"  id="id_no" name="quentity" placeholder="Id no....">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="quentity">Comment
                                        </label>
                                        <div >
                                            <input  type="text" class="form-control"  id="comment" name="quentity" placeholder="Comment....">   
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


        <!-- Modal delete product -->
        <div class="modal fade none-border" id="inproduct_delete_show">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="inproduct_action_delete_submit">
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
                    <h4 class="card-title">Products</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th  style="display:none" >Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th>Location</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($products as $product)
                                <tr>
                                    <td style="display:none">{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td style="width: 15%;"><img id="inhouse_img{{$product->id}}" style="width: 100%;height:82px"  src="{{asset('assets/images/inproduct/'.$product->image)}}" /></td>
                                    <td>{{$product->current_quentity}}</td>
                                    <td>{{$product->current_location}}</td>
                                    <td>{{$product->added_by}}</td>
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($product->id);
                                        @endphp
                                         <span class="edit">
                                            <a href="{{route('inorder_view')}}"  data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="view">
                                                    <i class="fa fa-eye color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span class="edit">
                                            <a href="#" id="editinproductshow" data-id="{{ $parameter }}" data-title="{{ $product->name }}"   data-toggle="tooltip" data-placement="top" title="Edit / Make Order">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span class="delete">
                                            <a href="" class="{{$parameter}}" id="inproduct_delete" data-toggle="tooltip" data-placement="top" title="Delete">
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