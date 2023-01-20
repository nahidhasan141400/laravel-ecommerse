@extends('admin.app')
@section('content')
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('admin_product_edit',[$product->id])}}" enctype="multipart/form-data"  method="post" id="step-form-horizontal" class="step-form-horizontal">
                            @csrf
                            <div>
                                <h4>General Details</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input value="{{$product->name}}" type="text" name="product_name" class="form-control" placeholder="Product Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input value="{{$product->code}}" type="text" name="code" class="form-control" placeholder="Product Code" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input value="{{$product->title}}" type="text" name="product_title" class="form-control" placeholder="Product Title" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input value="{{$product->current_location}}" type="text" name="current_location" class="form-control" placeholder="Current Location" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <select required name="product_category" id="product_category" class="form-control">
                                                        <option value="{{$product->productcategory->id}}" >{{$product->productcategory->name}}</option>
                                                        @foreach ($categorys as $category)
                                                            <option  value="{{$category->id}}" active>{{$category->name}}</option>
                                                        @endforeach  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <select name="product_child_category" id="product_child_category" class="form-control">
                                                    @if ($product->childcategory_id!=0)
                                                    <option value="{{$product->productchildcategory->id}}" >{{$product->productchildcategory->name}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <select required name="product_brand" id="product_brand" class="form-control">
                                                    <option value="{{$product->productbrand->id}}" >{{$product->productbrand->name}}</option>
                                                    <option  value=""></option>  
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                {{-- <input value="{{$product->quentity}}"  type="number" name="product_quentity" class="form-control" placeholder="Product Quntity..." required> --}}
                                                <input  type="number" name="product_quentity" class="form-control" placeholder="Product Quntity...">
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <textarea required class="form-control" id="product_description" name="product_description" rows="4" placeholder="Product description...">{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Seo</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input value="{{$product->tag}}"  type="text" name="product_meta_tag" class="form-control" placeholder="Product meta tag" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input value="{{$product->meta_title}}"  type="text" name="product_meta_title" class="form-control" placeholder="Product meta title" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea required class="form-control" id="product_meta_description" name="product_meta_description" rows="4" placeholder="Product meta description...">{{$product->meta_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Product Image</h4>
                                <section style="overflow-y: scroll">
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <!-- This area will show the uploaded files -->
                                            <div class="row">
                                                <div id="uploaded_images">
                                                    @foreach ($product->productallimage as $productallimage)
                                                    <div style="float:left;position: relative;margin-left:88px;"> 
                                                        <input type="text" value="{{$productallimage->image}}" name="uploaded_image_name[]" id="uploaded_image_name" hidden> 
                                                        <img  style="width:700%;position: absolute;" src="{{asset('assets/images/product/'.$productallimage->image)}}" /> 
                                                       
                                                            <a style="position: absolute;" href="{{route('delete_product_image',$productallimage->id)}}">
                                                                <i class="fa fa-times-circle">
                                                                </i>
                                                            </a> 
                                                        
                                                        <a style="cursor: pointer;" class="img_rmv" style="z-index:1"  href="#">
                                                            <i class="fa fa-times-circle">
                                                            </i>
                                                        </a>  
                                                       
                                                    </div>
                                      
                                                   
                                              
                                                    @endforeach
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
                                                    <input  id="fileupload" type="file" name="files" accept="image/x-png, image/gif, image/jpeg" >
                                                </span>
                                                    <br>
                                                    <br>
                                                    <!-- The global progress bar -->
                                                    <div id="progress" class="progress">
                                                        <div class="progress-bar progress-bar-success"></div>
                                                    </div>
                                                    <!-- The container for the uploaded files -->
                                                    <div id="files" class="files"></div>
                                                    <input {{!empty($product->productallimage)?"":"required"}} type="text" name="uploaded_file_name" id="uploaded_file_name" >
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
                                        <div class="col-2">
                                            <label class="col-form-label" for="flash_deal">Flash deal image
                                            </label>
                                            <div >
                                                <img id="brand_img{{$product->id}}" style="max-width: 100%;height:121px" src="{{asset('assets/images/product/'.$product->flash_deal_image)}}" />
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label" for="flash_deal">Upload new flash deal image
                                            </label>
                                            <div >
                                                <input {{!empty($product->flash_deal_image)?"":"required"}} type="file" class="form-control"  id="flash_deal"  name="flash_deal"/>   
                                            </div>
                                        </div>
                                        {{-- <div class="col-2">
                                            <label class="col-form-label" for="flash_deal">Featured image
                                            </label>
                                            <div >
                                                <img id="brand_img{{$product->id}}" style="max-width: 100%;max-height:121px" src="{{asset('assets/images/product/'.$product->featured_product_image)}}" />
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-3">
                                            <label class="col-form-label" for="flash_deal">Upload new featured image
                                            </label>
                                            <div >
                                                <input {{!empty($product->featured_product_image)?"":"required"}} type="file" class="form-control"  id="featured_product"  name="featured_product"/>   
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-4">
                                            <label class="col-form-label" for="video_link">Youtube video link
                                            </label>
                                            <div >
                                                <input   value="{{$product->video_link}}"  type="text" class="form-control"  id="video_link" name="video_link" placeholder="Enter your youtube video link..">   
                                            </div>
                                        </div> --}}
                                    </div>
                                    
                                </section>
                                <h4>Price Details</h4>
                                <section>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->unit_price}}"  class="form-control" type="number" name="product_unit_price" placeholder="Unit price...">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->purchase_price}}"  class="form-control" type="number" name="product_purchase_price" placeholder="Purchase price...">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->vat}}"  class="form-control" type="number" name="tax" placeholder="Tax...(%)">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->discount}}"  class="form-control" type="number" name="discount" placeholder="Discount amount...">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->shipping_cost}}"  class="form-control" type="number" name="shipping_cost" placeholder="Shipping cost...">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input required value="{{$product->finish_alert}}" class="form-control" type="number" name="finish_alert" placeholder="Product alert limit...">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <h4>Shopper choice</h4>
                                    <section>
                                        <div class="row">
                                            @php
                                                $customer_choice=unserialize($product->customer_choice);
                                                $i=1;
                                            @endphp
                                            @if ($customer_choice)
                                                @foreach ($customer_choice as $key => $value)
                                                    @php
                                                        $customer_choice_contents=explode(",",$value);
                                                    @endphp
                                                        <div style="width: 20%;float:left">
                                                            <div class="form-group">
                                                                <input style="height: 36px;padding-left:5px" type="text" multiple="multiple" name="option_head[]" value="{{$key}}" readonly>
                                                            </div>
                                                        </div>
                                                        <div id="after_head" style="width: 80%;float:left">
                                                            <div class="form-group">
                                                                @php
                                                                    $option_content="option_content_".$i."[]";
                                                                @endphp
                                                                <select name="{{$option_content}}" multiple="multiple" style="width:100%"   class="form-control dynamic-option-creation">
                                                                    @foreach ($customer_choice_contents as $customer_choice_content)
                                                                        <option value="{{$customer_choice_content}}" selected="" data-select2-id="{{$customer_choice_content}}">{{$customer_choice_content}}</option>  
                                                                    @endforeach   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach  
                                            @else
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
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" style="text-align: center">
                                                    <a class="{{$i}}" id="add_more_customer_choice_option" style="background: red;
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
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection