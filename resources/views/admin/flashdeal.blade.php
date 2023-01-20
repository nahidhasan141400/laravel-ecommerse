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
                            <form class="form-valide" action="{{route('flash_deal_save')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amount">Title
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control"  name="flash_product_title" placeholder="Enter a product title...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="s_date">Date
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" placeholder="2017-06-04" id="s_date" name="s_date">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                    <label class=" col-form-label btn btn-danger">To</span>
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" placeholder="2017-06-04" id="e_date" name="e_date">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="name">Product
                                    </label>
                                    <div class="col-lg-6">
                                        <select id="flash_deal_product" name="flash_product[]" multiple="multiple" class="col-lg-12 form-control multi-select">
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row discount_product" style="display: none">
                                    <label class="col-lg-2 col-form-label" for="amount">Discount
                                    </label>
                                    <div class="col-lg-8">
                                        <table class="table table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                </tr>
                                            </thead>
                                            <tbody id="more_flash_product">
                                                
                                            </tbody>
                                        </table>
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