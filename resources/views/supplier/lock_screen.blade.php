@extends('supplier.auth.app')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="index.html"> <h4>Relax We Are Here </h4></a>
                        <form class="mt-5 mb-3 login-input" method="get" action="{{route("admin_dashboard")}}">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <button class="btn login-form__btn submit w-100">Unlock</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection