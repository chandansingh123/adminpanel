@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Activities
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Activities</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">Activity List:</h3>
                </div>
                <div class="col-2">
                    <a href="/activity/add" class="btn btn-block btn-info" role="button"><i class="fa fa-plus"></i>&nbsp;Add
                        Activity</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="activities" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="padding-right: 5px">SN</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Created At</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('backend.activity.delete-model')

@endsection

@section('footer')
    {!! Html::script("backend/js/activity/activityList.js") !!}
    {!! Html::script("backend/js/activity/activity.js") !!}
@stop
