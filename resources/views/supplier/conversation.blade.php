@extends('supplier.app')
@section('content')
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
               
            </ol>
        </div>
    </div>
    <!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Conversations</h4>
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="display: none">Id</th>
                                    <th>Sending Date</th>
                                    <th>Subject</th>
                                    <th>Sender</th>
                                    <th>Reciever</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($messages as $message)
                                <tr>
                                    <td style="display: none">{{$message->id}}</td>
                                    <td>
                                        {{$message->created_at}}
                                        @if ($message->client_viewed==0)
                                            <span class="badge gradient-1 badge-pill badge-primary">New</span>
                                        @endif
                                    </td>
                                    <td>{{$message->product->name}}</td>
                                    @if ($message->sender==1)
                                        <td>Admin</td>
                                    @else
                                        <td>{{$message->supplier->name}}</td>
                                    @endif
                                    @if ($message->sender==0)
                                        <td>Admin</td>
                                    @else
                                        <td>{{$message->supplier->name}}</td>
                                    @endif
                                    <td>
                                        @php
                                            $parameter= Crypt::encrypt($message->id);
                                        @endphp
                                        <span class="view">
                                            <a href="{{route('supplier_message',$parameter)}}"   data-toggle="tooltip" data-placement="top" title="view details">
                                                <i class="btn btn-danger">view details</i>
                                            </a>
                                        </span>
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
@endsection