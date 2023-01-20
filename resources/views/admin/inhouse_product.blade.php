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
                            <form action="{{route('admin_product_save')}}" enctype="multipart/form-data"  method="post" id="step-form-horizontal" class="step-form-horizontal">
                                @csrf
                                <div>
                                    <h4>General Details</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="code" class="form-control" placeholder="Product code" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="product_title" class="form-control" placeholder="Product Title" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="current_location" class="form-control" placeholder="Current Location" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <select name="product_category" id="product_category" class="form-control" required>
                                                            <option value="0">Choose main category...</option>
                                                            @foreach ($category as $product_category)
                                                                <option  value="{{$product_category->id}}">{{$product_category->name}}</option>  
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <select name="product_child_category" id="product_child_category" class="form-control" required>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <select name="product_brand" id="product_brand" class="form-control" required>
                                                        <option value="0">Choose brand...</option>
                                                        @foreach ($brand as $product_brand)
                                                            <option  value="{{$product_brand->id}}">{{$product_brand->name}}</option>  
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="number" name="product_quentity" class="form-control" placeholder="Product Quntity..." required>
                                                </div>
                                            </div>
                                           
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="product_description" name="product_description" rows="4" placeholder="Product description..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>Seo</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" name="product_meta_tag" class="form-control" placeholder="Product meta tag" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" name="product_meta_title" class="form-control" placeholder="Product meta title" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="product_meta_description" name="product_meta_description" rows="4" placeholder="Product meta description..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>Image</h4>
                                    <section style="overflow-y: scroll">
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                <!-- This area will show the uploaded files -->
                                                <div class="row">
                                                    <div id="uploaded_images">
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div id="select_file">
                                                    <div class="form-group">
                                                        <label>Upload Product Image</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                                        <span class="btn btn-success fileinput-button">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                        <span>Select file...</span>
                                                            <!-- The file input field used as target for the file upload widget -->
                                                        <input id="fileupload" type="file" name="files" accept="image/x-png, image/gif, image/jpeg" >
                                                    </span>
                                                        <br>
                                                        <br>
                                                        <!-- The global progress bar -->
                                                        <div id="progress" class="progress">
                                                            <div class="progress-bar progress-bar-success"></div>
                                                        </div>
                                                        <!-- The container for the uploaded files -->
                                                        <div id="files" class="files"></div>
                                                        <input required type="text" name="uploaded_file_name" id="uploaded_file_name" >
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>Media Details </h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="col-form-label" for="flash_deal">Flash deal image
                                                </label>
                                                <div >
                                                    <input required type="file" class="form-control"  id="flash_deal"  name="flash_deal"/>   
                                                </div>
                                            </div>
                                        </div> 
                                    </section>
                                    <h4>Price Details</h4>
                                    <section>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input required class="form-control" type="number" name="product_unit_price" placeholder="Unit price...">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input required class="form-control" type="number" name="product_purchase_price" placeholder="Purchase price...">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input required class="form-control" type="number" name="tax" placeholder="Vat...(%)">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input  class="form-control" type="number" name="discount" placeholder="Discount amount...">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input required class="form-control" type="number" name="shipping_cost" placeholder="Shipping cost...">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input required class="form-control" type="number" name="finish_alert" placeholder="Product alert limit...">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>Shopper choice</h4>
                                    <section>
                                        <div class="row">
                                            <div style="width: 20%;float:left">
                                                <div class="form-group">
                                                    <input required style="height: 36px;padding-left:5px" type="text" multiple="multiple" name="option_head[]" value="colors" readonly>
                                                </div>
                                            </div>
                                            <div id="after_head" style="width: 80%;float:left">
                                                <div class="form-group">
                                                    <select  name="option_content_1[]" multiple="multiple" style="width:100%"   class="form-control dynamic-option-creation">
                                                            <option ></option>  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" style="text-align: center">
                                                    <a class="" id="add_more_customer_choice_option" style="background: red;
                                                    padding: 10px;
                                                    color: #fff;
                                                    border-radius: 5px;
                                                    cursor:pointer">Add more customer choice option</a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h4>Confirmation</h4>
                                    <section>
                                        <div class="row h-100">
                                            <div class="col-12 h-100 d-flex flex-column justify-content-center align-items-center">
                                                <button style="font-weight: 700" type="submit" class="btn btn-primary" name="submit">CLICK HERE TO FINISH</button>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
        <!-- Modal delete product -->
        <div class="modal fade none-border" id="product_action_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="product_action_delete_submit">
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
        <!-- Modal featured active product -->
        <div class="modal fade none-border" id="featured_product_action_active">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="featured_product_action_active_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="efa_id" name="e_id"/>
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

          <!-- Modal featured deactive product -->
          <div class="modal fade none-border" id="featured_product_action_deactive">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="featured_product_action_deactive_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="efda_id" name="e_id"/>
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

        <!-- Modal active product -->
        <div class="modal fade none-border" id="product_action_active">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="product_action_active_submit">
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
        <!-- Modal deactive product -->
        <div class="modal fade none-border" id="product_action_deactive">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="product_action_deactive_submit">
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
        <!-- Modal delete product -->
        <div class="modal fade none-border" id="product_action_active">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="product_action_active_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="ea_id" name="e_id"/>
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
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Logo</th>
                                    <th>Sale</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Rating</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($product as $product)
                                <tr>
                                    <td style="display:none">{{$product->id}}</td>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->name}}</td>
                                    <td style="width: 15%;"><img id="brand_img{{$product->id}}" style="width: 100%;height:82px"  src="{{asset('assets/images/product/'.$product->productimage->image)}}" /></td>
                                    <td>{{$product->quentity - $product->current_stock}}</td>
                                    <td>{{$product->current_stock}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->rating}}</td>
                                    <td>{{$product->added_by}}</td>
                                    <td>
                                        
                                        {{-- @if ($product->featured_status==1)
                                        <span class="active">
                                            <a href="" class="{{$product->id}}" id="featured_product_active" data-toggle="tooltip" data-placement="top" title="Featured product active">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$product->id}}" id="featured_product_deactive" data-toggle="tooltip" data-placement="top" title="Featured product deactive">
                                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @endif --}}
                                       
                                        <span class="edit">
                                            <a class="{{$product->id}}" href="{{route('admin_product_edit',[$product->id])}}" id="product_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="Product edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @if ($product->status==1)
                                        <span class="active">
                                            <a href="" class="{{$product->id}}" id="product_active" data-toggle="tooltip" data-placement="top" title="Product active">
                                                    <i class="fa fa-check color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$product->id}}" id="product_deactive" data-toggle="tooltip" data-placement="top" title="Product deactive">
                                                    <i class="fa fa-ban color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        @endif
                                        <span class="delete">
                                            <a href="" class="{{$product->id}}" id="product_delete" data-toggle="tooltip" data-placement="top" title="Product delete">
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