@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Top Bids
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Top Bids</li>
    <li class="breadcrumb-item active">Add Top Bid</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Add Top Bid</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'top-bid-add-form', 'url'=>'top-bid/store', 'role' => 'form', 'method' => 'POST']) !!}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity">
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" name="price" class="form-control" id="price" placeholder="Price">
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
    {!! Html::script("backend/js/top-bid/topBid.js") !!}
@stop
