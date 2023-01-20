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
                            <form class="form-valide" action="{{route('payment_method_submit')}}" method="post">
                                @csrf
            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="author">SSLCommerz Store Id  <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input required type="text" value={{$paymentmethodinfo->store_id}} class="form-control" id="author"  name="author" placeholder="SSLCommerz Store Id...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="sitemap">SSLCommerz Store Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input  required type="text" value={{$paymentmethodinfo->store_password}} class="form-control" id="sitemap"  name="sitemap" placeholder="SSLCommerz Store Password...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
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