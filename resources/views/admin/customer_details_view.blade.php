@extends('admin.app')
@section('content')
<div class="content-body">
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        @if ($customer->apply==2 || $customer->apply==1)
        <div class="col-3">
            <label class="col-form-label" for="be_seller_option">Approve
            </label>
            @php
                $parameter= Crypt::encrypt($customer->id);
            @endphp
            <select name="{{$parameter}}" id="be_seller_option" class="form-control">
                <option selected>
                    {{$customer_type=$customer->apply==0 ? 'B2C':($customer_type=$customer->apply==2?'B2C':'B2B')}}
                </option>
                @if ($customer->apply==2)
                    <option value="1">B2B</option>
                    <option  value="0">Reject</option>
                @else
                    <option value="0">B2C</option>
                @endif
            </select>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border">
                            <tbody>
                                <tr class="table-primary">
                                    <td style="text-align: center">Code :</td>
                                    <td>{{$customer->code}}</td>
                                </tr>
                                <tr class="table-success">
                                    <td style="text-align: center">Name :</td>
                                    <td>{{$customer->name}}</td>
                                </tr>
                                <tr class="table-info">
                                    <td style="text-align: center">Email :</td>
                                    <td>{{$customer->email}}</td>
                                </tr>
                                <tr class="table-warning">
                                    <td style="text-align: center">Phone :</td>
                                    <td>{{$customer->phone}}</td>
                                </tr>
                                <tr class="table-primary">
                                    <td style="text-align: center">Image :	</td>
                                    <td><img width="160px" src="{{asset('assets/images/profile/'.$customer->image)}}"/></td>
                                </tr>
                                <tr class="table-success">
                                    <td style="text-align: center">NID first :	</td>
                                    <td><img src="{{asset('assets/images/profile/'.$customer->id_image_1)}}"/></td>
                                </tr>
                                <tr class="table-info">
                                    <td style="text-align: center">NID second :	</td>
                                    <td><img src="{{asset('assets/images/profile/'.$customer->id_image_2)}}"/></td>
                                </tr>
                                <tr class="table-warning">
                                    <td style="text-align: center">Trade License :	</td>
                                    <td><img src="{{asset('assets/images/profile/'.$customer->trade_image_1)}}"/></td>
                                </tr>
                                <tr class="table-primary">
                                    <td style="text-align: center">Address :</td>
                                    <td>{{$customer->address}}</td>
                                </tr>
                                <tr class="table-success">
                                    <td style="text-align: center">Country :</td>
                                    <td>{{$customer->country}}</td>
                                </tr>
                                <tr class="table-info">
                                    <td style="text-align: center">City :</td>
                                    <td>{{$customer->city}}</td>
                                </tr>
                                <tr class="table-warning">
                                    <td style="text-align: center">Postal code :</td>
                                    <td>{{$customer->postal_code}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection