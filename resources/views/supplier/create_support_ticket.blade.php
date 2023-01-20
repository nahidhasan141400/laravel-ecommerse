@extends('supplier.app')
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
                        <form class="form-valide" action="{{route('create_support_ticket_submit')}}" method="get">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="subject" placeholder="Subject"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-10">
                                    <textarea placeholder="Subject" class="summernote" id="description" name="description"></textarea>
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