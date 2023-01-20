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
                        <h4 class="modal-title"><strong>Purchase New Product</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide" method="post" enctype="multipart/form-data" id="purchase_product_submit">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Supplier Name
                                        </label>
                                        <select name="name" id="name" class="form-control" required>
                                            <option value="0">Choose supplier...</option>
                                            @foreach ($supplierlists as $supplierlist)
                                                @php
                                                    $parameter= Crypt::encrypt($supplierlist->id);
                                                @endphp
                                                <option  value="{{$parameter}}">{{$supplierlist->name}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Chalan No.
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="chalan" name="chalan" placeholder="Enter a chalan no.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Order Id
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="order_id" name="order_id" placeholder="Enter a order id.." value="">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_description">Category
                                        </label>
                                        <select name="product_category" id="purchase_product_category" class="form-control" required>
                                                <option value="0">Choose category...</option>
                                                @foreach ($category as $product_category)
                                                    <option  value="{{$product_category->id}}">{{$product_category->name}}</option>  
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Product Name
                                        </label>
                                        <div>
                                            <select required style="width: 100%" name="product_name[]" multiple="multiple" class="form-control dynamic-option-creation" id="product_name">      
                                                {{-- @foreach ($keywords as $keyword)
                                                    <option value="{{$keyword}}" selected="" data-select2-id="{{$keyword}}">{{$keyword}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_description">Quantity
                                        </label>
                                        <div>
                                            <select required style="width: 100%" name="quantity[]" multiple="multiple" class="form-control dynamic-option-creation" id="quantity">      
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Unit Price
                                        </label>
                                        <div>
                                            <select required style="width: 100%" name="price[]" multiple="multiple" class="form-control dynamic-option-creation" id="purchase_product_price">      
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Total Amount
                                        </label>
                                        <div>
                                            <input id="total_purchase_product_amount"  type="text" class="form-control" value="">   
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
         <div class="modal fade none-border" id="purchaseproduct_action_delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="purchaseproduct_action_delete_submit">
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
         <div class="modal fade none-border" id="purchaseproduct_action_active">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="purchaseproduct_action_active_submit">
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
         <div class="modal fade none-border" id="purchaseproduct_action_deactive">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="purchaseproduct_action_deactive_submit">
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
                    <h4 class="card-title">Purchase products</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th  style="display:none" >Id</th>
                                    <th>Order Code</th>
                                    <th>Chalan No.</th>
                                    <th>Supplier Name</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                    <th>Quantity</th>
                                    <th>Add date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchaseproducts as $purchaseproduct)
                                @php
                                    
                                   $purchaseproduct_itemcodes=explode(',',unserialize($purchaseproduct->name));
                                   $purchaseproduct_amount=explode(',',unserialize($purchaseproduct->amount));
                                   $purchaseproduct_quantity=explode(',',unserialize($purchaseproduct->quantity));
                                   $count=count($purchaseproduct_itemcodes);
                                @endphp
                                @for ($i = 0; $i < $count; $i++)
                                <tr>
                                    <td style="display:none">{{$purchaseproduct->id}}</td>
                                    <td>{{$purchaseproduct->order_id}}</td>
                                    <td>{{$purchaseproduct->chalan_no}}</td>
                                    <td>{{$purchaseproduct->supplier->name}}</td>
                                    <td>{{$purchaseproduct_itemcodes[$i]}}</td>
                                    <td>{{$purchaseproduct->category_name->name}}</td>
                                    <td>{{$purchaseproduct_amount[$i]}} TK.</td>
                                    <td>{{$purchaseproduct_amount[$i]*$purchaseproduct_quantity[$i]}} TK.</td>
                                    <td>{{$purchaseproduct_quantity[$i]}}</td>
                                    <td>{{$purchaseproduct->created_at->toDateString()}}</td>
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($purchaseproduct->id);
                                            $order_code= Crypt::encrypt($purchaseproduct->order_id);
                                        @endphp
                                     @if ($purchaseproduct->status==1)
                                        <span class="active">
                                            <a href="" class="{{$parameter}}" id="purchaseproduct_active" data-toggle="tooltip" data-placement="top" title="Featured product active">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                     @else
                                        <span class="deactive">
                                            <a href="" class="{{$parameter}}" id="purchaseproduct_deactive" data-toggle="tooltip" data-placement="top" title="Featured product deactive">
                                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                     @endif
                                        <span class="edit">
                                            <a class="{{$parameter}}" href="{{route('purchase_product_edit',$parameter)}}" id="purchaseproduct_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="Product edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span  class="delete">
                                            <a href="" class="{{$parameter}}" id="purchaseproduct_delete" data-toggle="tooltip" data-placement="top" title="Delete Supplier">
                                                    <i class="fa fa-trash-o color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span class="active">
                                            <a href="{{route('pdf_purchaseproduct',[$parameter,$order_code])}}"  class="{{$parameter}}" id="invoice_download" data-toggle="tooltip" data-placement="top" title="download invoice">
                                                <i class="fa fa-download color-muted m-r-5" aria-hidden="true"></i>  
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                @endfor
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