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
                        <form class="form-valide" action="{{route('be_seller_submit')}}"  enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="name">Username <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input required value="{{$manage_profile->name}}" type="text" class="form-control" id="name" name="name" placeholder="Enter a username..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="image">Image <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <img width="160px" src="{{asset('assets/images/profile/'.$manage_profile->image)}}" />
                                    <input {{$manage_profile->image!=NULL?"":"required"}}  type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="image">Nid First Side <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    {{-- <img width="160px" src="{{asset('assets/images/profile/'.$manage_profile->id_image_1)}}" /> --}}
                                    <input required type="file" class="form-control" id="nid_first" name="nid_first">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="image">Nid Second Side <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    {{-- <img width="160px" src="{{asset('assets/images/profile/'.$manage_profile->id_image_2)}}" /> --}}
                                    <input required type="file" class="form-control" id="nid_second" name="nid_second">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="image">Trade License Image <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    {{-- <img width="160px" src="{{asset('assets/images/profile/'.$manage_profile->trade_image_1)}}" /> --}}
                                    <input required type="file" class="form-control" id="trade" name="trade">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input required value="{{$manage_profile->email}}" type="text" class="form-control" id="email" name="email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="phone">Phone<span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input required value="{{$manage_profile->phone}}" type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="address">Shipping Address <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <textarea required class="form-control" id="address" name="address" rows="5" placeholder="What would you like to see?">{{$manage_profile->address}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-skill">Country <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select required class="form-control" id="val-skill" name="val-skill">
                                        @if ($manage_profile->country!=NULL)
                                            <option value="{{$manage_profile->country}}">{{$manage_profile->country}}</option>
                                        @else
                                            <option value="0">Please select</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="city">City <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input required value="{{$manage_profile->city}}"  type="text" class="form-control" id="city" name="city" placeholder="Dhaka">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="postal_code">Postal code <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input required value="{{$manage_profile->postal_code}}" type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Your postal code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
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
<!-- #/ container -->
@endsection