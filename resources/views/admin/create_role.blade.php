@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="todo-list">
                    <div class="tdl-holder">
                        <div class="tdl-content2 tdl-content--no-label">
                            <form method="post" action="{{route('save_role')}}">
                            @csrf
                            <input type="text" name="role_name" class="tdl-new2 form-control" placeholder="Create a new role..." required>
                            <ul>
                                <li>
                                    <label><input  type="checkbox" name="product"><i></i><span>product</span><a href='#' class="ti-close"></a>
                                    </label>
                                </li>
                                <li>
                                    <label><input  type="checkbox" name="flashdeal"><i></i><span>flashdeal</span><a href='#' class="ti-close"></a>
                                    </label>
                                </li>
                                <li>
                                    <label><input  type="checkbox" name="order"><i></i><span>order</span><a href='#' class="ti-close"></a>
                                    </label>
                                </li>
                            </ul>
                            <li style="text-align: center">
                                <button  type="submit" class="btn btn-primary">Submit</button>
                            </li>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection