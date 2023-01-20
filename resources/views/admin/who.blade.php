@extends('admin.app')
@section('content')
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Be alert</h4>
                <div class="table-responsive">
                    <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th style="display: none">Id</th>
                                <th>Email</th>
                                <th>Ip</th>
                                <th>Role</th>
                                <th>Attempt</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($who as $who)
                            <tr>
                                <td style="display: none">{{$who->id}}</td>
                                <td>{{$who->email}}</td>
                                <td>{{$who->ip}}</td>
                                <td style="width: 1%">{{$who->role}}</td>
                                <td style="width: 1%">{{$who->total}}</td>
                                <td>
                                    @if ($who->total>5)
                                    <span class="delete">
                                        <a href="" class="" id="category_delete" data-toggle="tooltip" data-placement="top" title="Very dangerous">
                                                <i class="">Very dangerous</i> 
                                        </a>
                                    </span> 
                                    @else
                                    <span class="delete">
                                        <a href="" class="" id="category_delete" data-toggle="tooltip" data-placement="top" title="Less dangerous">
                                                <i class="">Less dangerous</i> 
                                        </a>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- #/ container -->
@endsection