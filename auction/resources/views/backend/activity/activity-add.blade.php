@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Activities
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Activities</li>
    <li class="breadcrumb-item active">Add Activity</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Add Activity</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'activity-add-form', 'url'=>'activity/store', 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name"
                           placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                        <textarea placeholder="Description" class="form-control" name="description" cols="40"
                                  rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="activity_date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="text" name="activity_date" class="form-control" id="activity_date" placeholder="Date">
                </div>
            </div>
            <div class="form-group row">
                <label for="file_name" class="col-sm-2 col-form-label"> Image</label>
                <div class="col-sm-6">
                    {!! Form::file('file_name', ['id' => 'file_name']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-6">
                    <label><input type="checkbox" name="status" checked class="flat-red">&nbsp;Active</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('footer')
    {!! Html::script("backend/js/activity/activity.js") !!}
@stop
