@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
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
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th  style="display:none" >Id</th>
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
                                    <td>{{$product->name}}</td>
                                    <td style="width: 15%;"><img id="brand_img{{$product->id}}" style="width: 100%;height:82px"  src="{{asset('assets/images/product/'.$product->productimage->image)}}" /></td>
                                    <td>{{$product->quentity - $product->current_stock}}</td>
                                    <td>{{$product->current_stock}}</td>
                                    <td>{{$product->unit_price}}</td>
                                    <td>{{$product->rating}}</td>
                                    <td>{{$product->added_by}}</td>
                                    <td>
                                        
                                        @if ($product->status==1)
                                        <span class="active">
                                            <a href="" class="{{$product->id}}" id="product_active" data-toggle="tooltip" data-placement="top" title="Featured product active">
                                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$product->id}}" id="product_deactive" data-toggle="tooltip" data-placement="top" title="Featured product deactive">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @endif
                                        
                                        @if ($product->status==1)
                                        <span class="active">
                                            <a href="" class="{{$product->id}}" id="product_active" data-toggle="tooltip" data-placement="top" title="Special product active">
                                                <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$product->id}}" id="product_deactive" data-toggle="tooltip" data-placement="top" title="Special product deactive">
                                                <i class="fa fa-handshake-o" aria-hidden="true"></i> 
                                            </a>
                                        </span>
                                        @endif
                                   
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