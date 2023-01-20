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
                            <form class="form-valide" action="{{route('newslater_submit')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amount">Emails (Users)
                                    </label>
                                    <div class="col-lg-6">
                                        <select name="user[]" multiple="multiple" class="col-lg-12 form-control" id="dynamic-option-creation">
                                            @foreach ($suppliers as $supplier)
                                                <option >{{$supplier->email}}</option>
                                            @endforeach
                                        </select>
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amount">Emails (Subscribers)
                                    </label>
                                    <div class="col-lg-6">
                                        <select name="subscriber[]" multiple="multiple" class="col-lg-12 form-control" id="dynamic-option-creation-1">
                                            @foreach ($subscribers as $subscriber)
                                                <option >{{$subscriber->email}}</option>
                                            @endforeach
                                        </select>
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
     
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="subject">Newsletter subject
                                    </label>
                                    <div class="col-lg-10">
                                        <input value="" type="text" class="form-control" id="subject"  name="subject">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Newsletter content
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea  class="summernote" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" style="float: right">
                                    <div class="col-lg-8 mt-5" >
                                        <button type="submit" class="btn btn-primary">Send</button>
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