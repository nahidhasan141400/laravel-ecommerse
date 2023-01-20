

@extends('admin.app')
@section('content')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            @php
                                $parameter= Crypt::encrypt($purchaseproduct->id);
                                $parameters= Crypt::encrypt($purchaseproduct->supplierlist_id);
                            @endphp
                            <form action="{{route('purchase_product_edit_submit',$parameter)}}" class="form-valide" enctype="multipart/form-data" method="post">
                                @csrf
                              
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Supplier Name
                                        </label>
                                        <select name="pname" id="pname" class="form-control" required>
                                            <option value="{{$parameters}}">{{$purchaseproduct->supplier->name}}</option>
                                            @foreach ($supplierlists as $supplierlist)
                                                @php
                                                    $parameters= Crypt::encrypt($supplierlist->id);
                                                @endphp
                                                <option  value="{{$parameters}}">{{$supplierlist->name}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Chalan No.
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="chalan" name="chalan"  value="{{$purchaseproduct->chalan_no}}">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="first_category">Order Id
                                        </label>
                                        <div >
                                            <input required type="text" class="form-control"  id="eorder_id" name="order_id" placeholder="Enter a order id.." value="{{$purchaseproduct->order_id}}">   
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_description">Category
                                        </label>
                                        <select name="product_category" id="purchase_product_category" class="form-control" required>
                                                <option value="{{$purchaseproduct->category}}">{{$purchaseproduct->category_name->name}}</option>
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
                                                @php
                                                    $item_codes=explode(',',unserialize($purchaseproduct->name));
                                                @endphp
                                                @foreach ($item_codes as $item_code)
                                                    <option value="{{$item_code}}" selected>{{$item_code}}</option>      
                                                @endforeach
                                                @foreach ($purchase_category_product as $purchase_category_product)
                                                    @php
                                                        $category_products=explode(',',unserialize($purchase_category_product->name));
                                                    @endphp
                                                    @foreach ($category_products as $category_product)
                                                        <option >{{$category_product}}</option>    
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_description">Quantity
                                        </label>
                                        <div>
                                            <select required style="width: 100%" name="quantity[]" multiple="multiple" class="form-control dynamic-option-creation" id="quantity">      
                                                @php
                                                    $quantitys=explode(',',unserialize($purchaseproduct->quantity));
                                                @endphp
                                                @foreach ($quantitys as $quantity)
                                                    <option value="{{$quantity}}" selected>{{$quantity}}</option>      
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_title">Unit Price
                                        </label>
                                        <div>
                                            <select required style="width: 100%" name="price[]" multiple="multiple" class="form-control dynamic-option-creation" id="purchase_product_price">      
                                                @php
                                                    $amounts=explode(',',unserialize($purchaseproduct->amount));
                                                @endphp
                                                @foreach ($amounts as $amount)
                                                    <option value="{{$amount}}" selected>{{$amount}}</option>      
                                                @endforeach
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
                                    <div class="col-lg-8 mt-5">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




