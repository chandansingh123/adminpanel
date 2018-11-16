@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Retailers
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Retailers</li>
@endsection

@section('content')

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Retailer List:</h3>
            <div class="pull-right box-tools">
                <a href="/user/add" class="btn btn-block btn-info" role="button"><i class="fa fa-plus"></i>&nbsp;Add Retailer</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="users" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="padding-right: 5px">SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    @include('backend.user.delete-model')

@endsection

@section('footer')
    {!! Html::script("backend/js/user/userList.js") !!}
@stop
