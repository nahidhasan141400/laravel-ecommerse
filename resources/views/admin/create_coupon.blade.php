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
                            <form class="form-valide" action="{{route('coupon_create_submit')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amount">Coupon Type
                                    </label>
                                    <div class="col-lg-6">
                                        <select id="coupon_type" name="type"  class="col-lg-12 form-control">
                                                <option value="0" selected> Select One</option>
                                                <option value="1"> For Products</option>
                                                <option value="2"> For Total Orders</option>
                                        </select>
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="coupon_display_none" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="author">Coupon Code
                                        </label>
                                        <div class="col-lg-6">
                                            <input value="" type="text" class="form-control" id="code"  name="code" placeholder="Coupon Code...">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="amount">Category</label>
                                        <div class="col-lg-6">
                                            <select id="coupon_category" name="category[]"  class="col-lg-12 form-control single-select">
                                                @php
                                                    $category=App\Models\Category::where('parent_id',NULL)->get();
                                                @endphp
                                                <option selected value="0">Select Category</option>
                                                @foreach ($category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="amount">Sub Category</label>
                                        <div class="col-lg-6">
                                            <select id="coupon_subcategory" name="subcategory[]"  class="col-lg-12 form-control single-select">
                                                
                                            </select>
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div  class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="amount">Product</label>
                                        <div class="col-lg-6">
                                            <select id="coupon_product"  name="product[]"  class="col-lg-12 form-control single-select">
                                                
                                            </select>
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div style="border-top: 1px solid #eee; margin-bottom: 5px;" id="after_this"></div>
                                    <div class="form-group row">
                                        <label class="col-lg-6 col-form-label" for="coupon_product_add_more"></label>
                                        <div class="col-lg-2">
                                            <a id="coupon_product_add_more" style="color:#fff; width:100%" class="btn btn-primary">Add More</a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="s_date">Date
                                        </label>
                                        <div class="col-lg-3">
                                            <input  type="text" class="form-control" placeholder="2017-06-04" id="s_date" name="s_date">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                        <label class=" col-form-label btn btn-danger">To</span>
                                        </label>
                                        <div class="col-lg-3">
                                            <input  type="text" class="form-control" placeholder="2017-06-04" id="e_date" name="e_date">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="amount">Discount
                                        </label>
                                        <div class="col-lg-6">
                                            <input  type="text" class="form-control"  name="product_discount" placeholder="Upto 100%">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 mt-5">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="coupon_total_order_none" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="author">Coupon Code
                                        </label>
                                        <div class="col-lg-6">
                                            <input value="" type="text" class="form-control" name="codes" placeholder="Coupon Code...">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="author">Minimum Shopping
                                        </label>
                                        <div class="col-lg-6">
                                            <input value="" type="text" class="form-control"  name="minimum_shopping" placeholder="Minimum shopping amount...">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="author">Discount
                                        </label>
                                        <div class="col-lg-6">
                                            <input value="" type="text" class="form-control"   name="product_discounts" placeholder="Discount percent...%">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="author">Maximum Discount
                                        </label>
                                        <div class="col-lg-6">
                                            <input value="" type="text" class="form-control"  name="maximum_product_discount" placeholder="Maximum discount amount...">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label" for="s_date">Date
                                        </label>
                                        <div class="col-lg-3">
                                            <input  type="text" class="form-control s_date" placeholder="2017-06-04"  name="st_date">
                                           
                                        </div>
                                        <label class=" col-form-label btn btn-danger">To</span>
                                        </label>
                                        <div class="col-lg-3">
                                            <input  type="text" class="form-control e_date" placeholder="2017-06-04"  name="et_date">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 mt-5">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
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