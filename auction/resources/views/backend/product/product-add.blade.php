@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Products
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Add Product</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Add Product</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'product-add-form', 'url'=>'product/store', 'role' => 'form', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="delivery_date" class="col-sm-3 col-form-label">Delivery Date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="delivery_date" class="form-control" id="delivery_date"
                                       placeholder="Delivery Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="min_reserved_price" class="col-sm-3 col-form-label">Min. Reserved Price</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="min_reserved_price" class="form-control" id="min_reserved_price"
                                       placeholder="Min. Reserved Price">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">RS.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-8">
                        <textarea placeholder="Description" class="form-control" name="description" cols="40"
                                  rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clearing_price" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-info" id="btn-product">Save</button>
                        </div>
                    </div>
                </div>
                <div class="col">

                    <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Item</label>
                        <div class="col-sm-8">
                            {!! Form::select('item_id', $items, null, ['placeholder' => 'Select a item', 'id' => 'item_id','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="closed_date" class="col-sm-3 col-form-label">Closed Date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="closed_date" class="form-control" id="closed_date"
                                       placeholder="Closed Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="offer_quantity" class="col-sm-3 col-form-label">Total Offer</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="offer_quantity" class="form-control" id="offer_quantity"
                                       placeholder="Total Offer">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                            <label><input type="checkbox" name="status" checked class="flat-red">&nbsp;Active</label>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('footer')
    {!! Html::script("backend/js/product/product.js") !!}
@stop
