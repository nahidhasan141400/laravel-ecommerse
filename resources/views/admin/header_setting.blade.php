@extends('admin.app')
@section('content')
<!--**********************************
            Content body start
        ***********************************-->
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
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 m-b-30">
                                <div class="col-md-12 m-b-30">
                                    <div class="example">
                                        <h5 class="box-title">Logo Background Color</h5>
                                        <input type="text" class="colorpicker form-control" value="#7ab2fa">
                                    </div>
                                    <div class="example mt-3">
                                        <h5 class="box-title">Header Background Color</h5>
                                        <input type="text" class="colorpicker form-control" value="#7ab2fa">
                                    </div>
                                    <div class="example mt-3">
                                        <h5 class="box-title">Header Font Color</h5>
                                        <input type="text" class="colorpicker form-control" value="#7ab2fa">
                                    </div>
                                    <button type="submit" class="btn btn-dark mb-2 mt-3">Submit</button>
                                </div>
                            </div>
                            <div class="col-md-4 m-b-30">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Upload Header Logo</h4>
                                        <div class="basic-form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="file" class="form-control-file">
                                                </div>
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
    </div>
</div>
@endsection