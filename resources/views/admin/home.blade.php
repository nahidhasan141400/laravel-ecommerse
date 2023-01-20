@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="slider">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Slider</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="post"  enctype="multipart/form-data" id="slider_submit">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_logo">Image
                                        </label>
                                        <div id="image-error">
                                            <input type="file" class="form-control"  id="slider_image" name="slider_image">
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
         <!-- Modal delete product -->
         <div class="modal fade none-border" id="slider_delete_action">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="slider_delete_submit">
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
           <!-- Modal active -->
           <div class="modal fade none-border" id="slider_active_action">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="slider_active_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="ea_id" name="e_id"/>
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
             <!-- Modal deactive -->
             <div class="modal fade none-border" id="slider_deactive_action">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="slider_deactive_submit">
                                    @csrf
                                    <div class="row">
                                        <input style="display: none" type="text" id="eda_id" name="e_id"/>
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























             <!-- Modal Banner1 -->
        <div class="modal fade none-border" id="banner1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Instragram Feed</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="post"  enctype="multipart/form-data" id="banner1_submit">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_logo">Url
                                        </label>
                                        <div id="image-error">
                                            <input type="text" class="form-control"  id="banner1_url" name="banner1_url">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label" for="category_logo">Image
                                        </label>
                                        <div id="image-error">
                                            <input type="file" class="form-control"  id="banner1_image" name="banner1_image">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="col-form-label" for="category_logo">Description
                                        </label>
                                        <div id="image-error">
                                            <textarea required class="form-control" id="description" name="description" rows="4" placeholder="What would you like to see?"></textarea>
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
         <!-- Modal delete product -->
         <div class="modal fade none-border" id="banner1_delete_action">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="banner1_delete_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="eod_id" name="e_id"/>
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
           <!-- Modal active -->
           <div class="modal fade none-border" id="banner1_active_action">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-validation">
                            <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="banner1_active_submit">
                                @csrf
                                <div class="row">
                                    <input style="display: none" type="text" id="eoa_id" name="e_id"/>
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
             <!-- Modal deactive -->
             <div class="modal fade none-border" id="banner1_deactive_action">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-validation">
                                <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="banner1_deactive_submit">
                                    @csrf
                                    <div class="row">
                                        <input style="display: none" type="text" id="eoda_id" name="e_id"/>
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
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item" ><a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Home Slider</a>
                </li>
                <li class="nav-item"><a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Instragram Feed</a>
                </li>
                {{-- <li class="nav-item"><a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="false">Home Banner 2</a>
                </li> --}}
            </ul>
            <div class="tab-content br-n pn">
                <div id="navpills-1" class="tab-pane active">
                    <div class="row">
                        <div class="col-lg-9 mb-3">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <a href="#" data-toggle="modal" data-target="#slider" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Add New Slider</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 ">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th style="display: none">Id</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            @php
                                                $parameter= Crypt::encrypt($slider->id);
                                            @endphp
                                            <td style="display: none">{{$parameter}}</td>
                                            <td><img id="" style="height:82px"  src="{{asset('assets/frontend/image/banners/'.$slider->photo)}}" /></td>
                                            <td>
                                                @if ($slider->status==1)
                                                    <span class="active">
                                                        <a class="{{$parameter}}" id="slider_active" data-toggle="tooltip" data-placement="top" title="active">
                                                            <i class="fa fa-check color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="deactive">
                                                        <a  class="{{$parameter}}" id="slider_deactive" data-toggle="tooltip" data-placement="top" title="deactive">
                                                            <i class="fa fa-ban color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @endif
                                                <span class="delete">
                                                    <a  class="{{$parameter}}" id="slider_delete" data-toggle="tooltip" data-placement="top" title="delete">
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
                <div id="navpills-2" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-9 mb-3">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <a href="#" data-toggle="modal" data-target="#banner1" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Add New Banner</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 ">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th style="display: none">Id</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners1 as $banner1)
                                        <tr>
                                            @php
                                                $parameter= Crypt::encrypt($banner1->id);
                                            @endphp
                                            <td style="display: none">{{$parameter}}</td>
                                            <td><img  style="height:82px"  src="{{asset('assets/frontend/image/banners/'.$banner1->photo)}}" /></td>
                                            <td>{{$banner1->description}}</td>
                                            <td style="width:100%;">
                                                @if ($banner1->status==1)
                                                    <span class="active">
                                                        <a class="{{$parameter}}" id="banner1_active" data-toggle="tooltip" data-placement="top" title="active">
                                                            <i class="fa fa-check color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="deactive">
                                                        <a  class="{{$parameter}}" id="banner1_deactive" data-toggle="tooltip" data-placement="top" title="deactive">
                                                            <i class="fa fa-ban color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @endif
                                                <span class="delete">
                                                    <a  class="{{$parameter}}" id="banner1_delete" data-toggle="tooltip" data-placement="top" title="delete">
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
                <div id="navpills-3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-9 mb-3">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <a href="#" data-toggle="modal" data-target="#banner2" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Add New Instragram Feed</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 ">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th style="display: none">Id</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners2 as $banner2)
                                        <tr>
                                            @php
                                                $parameter= Crypt::encrypt($banner2->id);
                                            @endphp
                                            <td style="display: none">{{$parameter}}</td>
                                            <td><img  style="height:82px"  src="{{asset('assets/frontend/image/banners/'.$banner2->photo)}}" /></td>
                                            <td style="width:100%;">
                                                @if ($banner2->status==1)
                                                    <span class="active">
                                                        <a class="{{$parameter}}" id="banner2_active" data-toggle="tooltip" data-placement="top" title="active">
                                                            <i class="fa fa-check color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @else
                                                    <span class="deactive">
                                                        <a  class="{{$parameter}}" id="banner2_deactive" data-toggle="tooltip" data-placement="top" title="deactive">
                                                            <i class="fa fa-ban color-muted m-r-5" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                @endif
                                                <span class="delete">
                                                    <a  class="{{$parameter}}" id="banner2_delete" data-toggle="tooltip" data-placement="top" title="delete">
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
</div>
@endsection