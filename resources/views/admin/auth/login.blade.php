@extends('admin.auth.app')
    @section('content')
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
                                <a class="text-center mt-3" href="index.html"> <h4 class="text-success">Welcome To Control Panel</h4></a>
                                <div class="text-center mb-3">
                                    {{-- <button type="button" class="btn btn-success " ></button>
                                    <button type="button" class="btn btn-danger"></button> --}}
                                </div>
                                <form class="form-valide" action="{{route('admin_login')}}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email address..">
                                            @error('email')
                                  
                                    <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{ $message }}</div>
                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Type your password..">
                                            <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{$errors->first('password')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                       
                                        <div class="col-lg-12">
                                            <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                                <input type="checkbox" class="css-control-input" id="val-terms" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="css-control-indicator"></span>   &nbsp Remmember me</label>
                                        </div>
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account ? <a href="{{route('admin_register')}}" class="text-primary">Sign Up</a> now | Or <a href="{{route('password.request')}}" class="text-primary">Forget Password ?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    

    




