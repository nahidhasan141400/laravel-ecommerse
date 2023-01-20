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
        <div class="col-lg-2 mb-3">
            <a href="{{route('create_support_ticket')}}"  class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create ticket</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Support Desk</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Sending Date</th>
                                    <th>Subject</th>
                                    <th>details</th>
                                    <th>Status</th>
                                    <th>Last Reply</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        {{$ticket->code}}
                                        @if ($ticket->client_viewed==0)
                                            <span class="badge gradient-1 badge-pill badge-primary">New</span>
                                        @endif
                                    </td>
                                    <td>{{$ticket->created_at}}</td>
                                    <td>{{$ticket->subject}}</td>
                                    <td>{!!$ticket->details!!}</td>
                                    <td>
                                        @if ($ticket->status=="0")
                                            <span class="view">
                                                <a href=""   data-toggle="tooltip" data-placement="top" title="Pending">
                                                    <i class="btn btn-danger">Pending</i>
                                                </a>
                                            </span> 
                                        @else
                                            <span class="view">
                                                <a href=""   data-toggle="tooltip" data-placement="top" title="Problem Solved">
                                                    <i class="btn btn-success">Solved</i>
                                                </a>
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{$ticket->updated_at}}</td>
                                    <td>
                                        <span class="view">
                                            @php
                                                $parameter= Crypt::encrypt($ticket->id);
                                            @endphp
                                            <a href="{{route('supplier_support_ticket_reply',$parameter)}}"   data-toggle="tooltip" data-placement="top" title="view details">
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