@extends('admin.app')
@section('content')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
               
            </ol>
        </div>
    </div>
    <div class="container-fluid"> 
        <form class="form-valide" action="{{route('allpolicy')}}" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="description">About Us
                </label>
                <input style="display: none" type="text" name="name" value="about_us"/>
                <div class="col-lg-10">
                    <textarea  class="summernote" id="description" name="description">{{$policy!=NULL?$policy->content:""}}</textarea>
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
@endsection