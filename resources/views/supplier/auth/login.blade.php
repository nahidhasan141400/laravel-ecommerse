@extends('supplier.frontend.app')
@section('content')
<section class="collection cart_collection">
    <div class="container">
        <div class="row">
            <div class="colum-50">
                <div class="row">
                    <div class="colum-100" style="margin-top: 42px">
                        <a href="#"><img src="{{asset('assets/frontend/mehromah/img/6.jpg')}}"></a>
                    </div>
                </div>
            </div>
            <div class="colum-50">
                <div class="row">
                    <div class="colum-100">
                        <h1>Signin</h1>
                    </div>
                    <div class="colum-100">
                        <div class="row border_l_b">
                            <div class="colum-100">
                                <form class="auth" {{route('supplier_login')}}" method="POST">
                                    @csrf
                                    <div class="colum-100">
                                        <label for="email">Email</label>
                                        <input required id="email" type="email" name="email" placeholder="Email">
                                    </div>
                                    
                                    <div class="colum-100">
                                        <label for="password">Password</label>
                                        <input required id="password" type="password" name="password" placeholder="Password">
                                    </div>
                                 
                                    <div class="row">
                                        <div class="colum-30">
                                            <button class="add_to_cart">SIGNIN</button>
                                        </div>
                                    </div>
                                    
                                    <div class="colum-30">
                                        <a href="{{route('supplier_register')}}">SIGNUP</a>
                                    </div>
                                    <div class="colum-30">
                                        <a href="{{route('password.request')}}">Forgot Password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

    

    




