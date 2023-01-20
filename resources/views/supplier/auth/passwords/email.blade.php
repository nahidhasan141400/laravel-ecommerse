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
                               <a class="text-center" href="index.html"> <h4 class="text-success">Don't Worry</h4></a>
       
                           <form class=" mt-5 mb-5 form-valide" action="{{route('password.email')}}" method="POST">
                                   @csrf
                                   <div class="form-group row">
                                       <div class="col-lg-12">
                                           <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email address..">
                                           @error('email')
                                 
                                   <div id="admin_name-error" class="invalid-feedback animated fadeInDown" style="display: block;">{{ $message }}</div>
                               @enderror
                                           
                                       </div>
                                   </div>
                                   <button class="btn login-form__btn submit w-100">Send Reset Password Link</button>
                               </form>
                               
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   @endsection

   

   




