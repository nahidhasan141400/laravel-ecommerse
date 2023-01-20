@extends('admin.auth.app')
@section('content')
<body class="h-100">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center mt-3" href="{{route('admin_register')}}">
                                     <h4 class="mb-2 text-success">Create your account</h4>
                                </a>
                                <div class="text-center mb-3">
                                    {{-- <button type="button" class="btn btn-success " ></button>
                                    <button type="button" class="btn btn-danger"></button> --}}
                                </div>
                                
                                <form class="form-valide" action="{{route('admin_register')}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input  type="text" class="form-control" id="name" name="name" placeholder="Enter a username..">
                                            <div  class="animated fadeInDown" style="display: block;">{{$errors->first('name')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input  type="text" class="form-control" id="email" name="email" placeholder="Your valid email..">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('email')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input  type="password" class="form-control" id="password" name="password" placeholder="Type your password..">
                                            <div  class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('password')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input  type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password..">
                                        </div>
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign Up</button>
                                </form>
                                    <p class="mt-5 login-form__footer">Have account ? <a href="{{route('admin_login')}}" class="text-primary">Sign In </a> now</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection