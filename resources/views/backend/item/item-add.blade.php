@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Item
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Item</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Item</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'item-form', 'url'=>'item/store', 'role' => 'form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
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
                    <label for="clearing_price" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-info" id="btn-product">Save</button>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection

@section('footer')

    {!! Html::script("backend/js/item/item.js") !!}

@stop
