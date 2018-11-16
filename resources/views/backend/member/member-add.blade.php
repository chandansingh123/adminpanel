@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Members
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Members</li>
    <li class="breadcrumb-item active">Add Member</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Add Member</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'member-add-form', 'url'=>'member/store', 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label"> Photo</label>
                <div class="col-sm-6">
                    {!! Form::file('photo', ['id' => 'photo']) !!}
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
    {!! Html::script("backend/js/member/member.js") !!}
@stop
