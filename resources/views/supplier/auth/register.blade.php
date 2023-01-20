@extends('supplier.frontend.app')
@section('content')
<section class="collection cart_collection">
    <div class="container">
        <div class="row">
            <div class="colum-50">
                <div class="row">
                    <div class="colum-100" style="margin-top: 35px">
                        <a href="#"><img src="{{asset('assets/frontend/mehromah/img/6.jpg')}}"></a>
                    </div>
                </div>
            </div>
            <div class="colum-50">
                <div class="row">
                    <div class="colum-100">
                        <h1>Signup</h1>
                    </div>
                    <div class="colum-100">
                        <div class="row border_l_b">
                            <div class="colum-100">
                                <form class="auth" action="{{route('supplier_register')}}" method="POST">
                                    @csrf
                                    <div class="colum-100">
                                        <label for="f_name">First Name</label>
                                        <input required id="f_name" type="text" name="name" placeholder="First Name">
                                    </div>
                                   
                                    <div class="colum-100">
                                        <label for="email">Email</label>
                                        <input required id="email" type="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="colum-100">
                                        <label for="p_number">Phone Number</label>
                                        <input required id="p_number" type="text" name="phone" placeholder="Phone Number">
                                    </div>
                                    <div class="colum-100">
                                        <label for="address">Address</label>
                                        <textarea required  id="address" name="address" placeholder="Address"></textarea>
                                    </div>
                                    <div class="colum-100">
                                        <label for="password">Password</label>
                                        <input required id="password" type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="colum-30">
                                        <button class="add_to_cart">SIGNUP</button>
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