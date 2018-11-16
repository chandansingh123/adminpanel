@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Pages
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Pages</li>
    <li class="breadcrumb-item active">Update</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Update</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'page-update-form', 'url'=>'page/update', 'role' => 'form', 'method' => 'POST']) !!}
            {!! Form::hidden('id', $page->id , array('id' => 'id')) !!}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name" value="{{$page->name}}" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-6">
                        <textarea placeholder="Description" class="form-control" name="description" cols="40"
                                  rows="3">{{$page->description}}</textarea>
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
    {!! Html::script("backend/js/page/page.js") !!}
@stop
