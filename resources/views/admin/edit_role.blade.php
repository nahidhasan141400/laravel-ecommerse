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
                            <form method="post" action="{{route('edit_role_save',$role->id)}}">
                            @csrf
                            <input value="{{$role->name}}" type="text" name="role_name" class="tdl-new2 form-control" placeholder="Create a new role..." required>
                            <ul>
                                @foreach ($sections as $section)
                                    @if ($section=="product")
                                        @php
                                            $product_1=1;
                                        @endphp
                                        <li>
                                            <label><input checked type="checkbox" name="product"><i></i><span>product</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @elseif($section=="flashdeal")
                                        @php
                                            $product_2=2;
                                        @endphp
                                        <li>
                                            <label><input checked type="checkbox" name="flashdeal"><i></i><span>flashdeal</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @elseif($section=="order")
                                        @php
                                            $product_3=3;
                                        @endphp
                                        <li>
                                            <label><input checked type="checkbox" name="order"><i></i><span>order</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                                    @if($product_1!=1) 
                                        <li>
                                            <label><input  type="checkbox" name="product"><i></i><span>product</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @elseif($product_2!=2)
                                        <li>
                                            <label><input type="checkbox" name="flashdeal"><i></i><span>flashdeal</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @elseif($product_3!=3)
                                        <li>
                                            <label><input  type="checkbox" name="order"><i></i><span>order</span><a href='#' class="ti-close"></a>
                                            </label>
                                        </li>
                                    @endif
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