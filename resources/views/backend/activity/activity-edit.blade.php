@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Activities
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Activities</li>
    <li class="breadcrumb-item active">Edit Activity</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Edit Activity</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'activity-edit-form', 'url'=>'activity/update', 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {!! Form::hidden('id', $activity->id , array('id' => 'id')) !!}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name"
                           placeholder="Name" value="{{$activity->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                        <textarea placeholder="Description" class="form-control" name="description" cols="40"
                                  rows="3">{{$activity->description}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="activity_date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="text" name="activity_date" class="form-control" id="activity_date" placeholder="Date"
                           value="{{date("Y-m-d", strtotime($activity->activity_date))}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="file_name" class="col-sm-2 col-form-label"> Image</label>
                <div class="col-sm-6">
                    {!! Form::file('file_name', ['id' => 'file_name']) !!}
                </div>
            </div>
            <div class="form-group row" id="preview">
                <label for="preview" class="col-sm-2 control-label">Preview</label>
                <div class="col-sm-8">
                    {!! Html::image('/uploads/activities/thumbs/'.$activity->file_name, 'Activity Image', array('class' => 'img-thumbnail')) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-6">
                    <?php $checkedStatus = (int) $activity->status === 1 ? "checked" : ""; ?>
                    <label><input type="checkbox" name="status" <?php echo $checkedStatus?> class="flat-red">&nbsp;Active</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('footer')
    {!! Html::script("backend/js/activity/activity.js") !!}
@stop
