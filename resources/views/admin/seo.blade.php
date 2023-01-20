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
                            <form class="form-valide" action="{{route('home_seo_submit')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amount">Keyword <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select name="keyword[]" multiple="multiple" class="col-lg-12 form-control" id="dynamic-option-creation">
                                            @foreach ($keywords as $keyword)
                                                <option value="{{$keyword}}" selected="" data-select2-id="{{$keyword}}">{{$keyword}}</option>
                                            @endforeach
                                        </select>
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="author">Author <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$seosetting->author}}" type="text" class="form-control" id="author"  name="author" placeholder="Enter a author name...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="sitemap">Site map link <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input  value="{{$seosetting->sitemap}}" type="text" class="form-control" id="sitemap"  name="sitemap" placeholder="Enter a author name...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="What would you like to see?">{{$seosetting->description}}</textarea>
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