@extends('admin.app')
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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">problem #{{$tickets->code}} </h4>
                        <h6 >{{$tickets->supplier->name}} {{$tickets->created_at}}</h6>
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('admin_support_ticket_reply_submit',$tickets->id)}}" method="get">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <input style="display: none" type="text" name="supplier" value="{{$tickets->supplier_id}}"/>
                                        <textarea  class="summernote" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 mt-5">
                                        <button type="submit" class="btn btn-primary">Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Previous Converssations</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Messsage</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reply_messages as $reply_message)
                                        <tr>
                                            @if ($reply_message->sender==1)
                                                <td>Admin</td>
                                            @else
                                                <td>{{$reply_message->supplier->name}}</td>
                                            @endif
                                            @if ($reply_message->receiver==1)
                                                <td>Admin</td>
                                            @else
                                                <td>{{$reply_message->supplier->name}}</td>
                                            @endif
                                            <td>{!! $reply_message->reply !!}</td>
                                            <td>{{$reply_message->created_at}}</td>
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