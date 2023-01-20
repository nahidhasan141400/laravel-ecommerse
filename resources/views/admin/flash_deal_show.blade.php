@extends('admin.app')
@section('content')
<div class="content-body">
  
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="{{route('flash_deal')}}" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
        </div>
    </div>
      <!-- Modal flash active product -->
      <div class="modal fade none-border" id="flashdeal_product_action_deactive">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="flashdeal_product_action_deactive_submit">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <input style="display: none" type="text" id="eda_id" name="e_id"/>
                                </div>
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
    <!-- Modal flash active product -->
    <div class="modal fade none-border" id="flashdeal_product_action_active">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="flashdeal_product_action_active_submit">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <input style="display: none" type="text" id="ea_id" name="e_id"/>
                                </div>
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
     <!-- Modal flash active product -->
     <div class="modal fade none-border" id="flashdeal_product_action_delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Are You Sure?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-valide"  method="POST"  enctype="multipart/form-data" id="flashdeal_product_action_delete_submit">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <input style="display: none" type="text" id="ed_id" name="e_id"/>
                                </div>
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
    {{-- End --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Flash Deal</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Title</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Discount</th>
                                    <th>Url</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td style="display: none">{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->start}}</td>
                                    <td>{{$item->end}}</td>
                                    <td>{{$item->discount}}.00 %</td>
                                    <td>{{$item->url}}</td>
                                    <td>
                                        @if ($item->status!=0)
                                        <span class="active">
                                            <a href="" class="{{$item->id}}" id="flashdeal_product_active" data-toggle="tooltip" data-placement="top" title="Product active">
                                                <i class="fa fa-check color-muted m-r-5" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @else
                                        <span class="deactive">
                                            <a href="" class="{{$item->id}}" id="flashdeal_product_deactive" data-toggle="tooltip" data-placement="top" title="Product deactive">
                                                <i class="fa fa-ban color-muted m-r-5" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        @endif
                                        <span class="edit">
                                            <a href="{{route('flash_product_edit',$item->code)}}" class="{{$item->id}}"  id="flashdeal_product_edit" data-id="" data-title=""   data-toggle="tooltip" data-placement="top" title="Product edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i> 
                                            </a>
                                        </span>
                                        <span class="delete">
                                            <a href="" class="{{$item->id}}" id="flashdeal_product_delete" data-toggle="tooltip" data-placement="top" title="Product delete">
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