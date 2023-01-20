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
                            <form class="form-valide" action="{{route('general_setting_submit')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="author">Color 
                                    </label>
                                    <div class="col-lg-6">
                                        <div class="example mt-3">
                                            <input name="color" type="text" class="colorpicker form-control" value="{{$setting!=NULL ? $setting->color:""}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="frontendlogo">Frontend logo 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="" type="file" class="form-control" id="frontendlogo"  name="frontendlogo" placeholder="Enter a address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                    @php
                                       $frontend_logo=$setting!=NULL?$setting->logo:"";
                                    @endphp
                                    <div class="col-lg-4">
                                        <img style="width: 100%;height:auto" src="{{asset('assets/images/setting/'.$frontend_logo)}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="frontendlogo">Backend logo 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="" type="file" class="form-control" id="backendlogo"  name="backendlogo" placeholder="Enter a address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                    @php
                                       $backend_logo=$setting!=NULL?$setting->admin_logo:"";
                                    @endphp
                                    <div class="col-lg-4">
                                        <img style="width: 100%;height:auto" src="{{asset('assets/images/setting/'.$backend_logo)}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="favicon">Favicon 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="" type="file" class="form-control" id="favicon"  name="favicon" placeholder="Enter a address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                    @php
                                       $favicon_logo=$setting!=NULL?$setting->favicon:"";
                                    @endphp
                                    <div class="col-lg-4">
                                        <img style="width: 100%;height:auto" src="{{asset('assets/images/setting/'.$favicon_logo)}}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="address">Address 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->address:""}}" type="text" class="form-control" id="address"  name="address" placeholder="Enter a address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Footer text 
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="What would you like to see?">{{$setting!=NULL ? $setting->description:""}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="phone">Phone 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->phone:""}}" type="text" class="form-control" id="phone"  name="phone" placeholder="Enter a phone number...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="email">Email 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->email:""}}" type="email" class="form-control" id="email"  name="email" placeholder="Enter a email address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="facebook">Facebook 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->facebook:""}}" type="text" class="form-control" id="facebook"  name="facebook" placeholder="Enter a facebbok address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="instagram">Instagram 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->instagram:""}}" type="text" class="form-control" id="instagram"  name="instagram" placeholder="Enter a instagram address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="twitter">Twitter 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->twitter:""}}" type="text" class="form-control" id="twitter"  name="twitter" placeholder="Enter a twitter address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="youtube">Youtube 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->youtube:""}}" type="text" class="form-control" id="youtube"  name="youtube" placeholder="Enter a youtube address...">
                                        <div  class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="youtube">Linkedin 
                                    </label>
                                    <div class="col-lg-6">
                                        <input value="{{$setting!=NULL ? $setting->linkedin:""}}" type="text" class="form-control" id="youtube"  name="linkedin" placeholder="Enter a linkedin address...">
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