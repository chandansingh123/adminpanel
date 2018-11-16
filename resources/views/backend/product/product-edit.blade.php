@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Products
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-error">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">Edit Product</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['class' => 'form-horizontal','id' => 'product-edit-form', 'url'=>'product/update', 'role' => 'form', 'method' => 'POST']) !!}
            {!! Form::hidden('id', $product->id , array('id' => 'id')) !!}
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="progress" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="Name" value="{{$product->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="delivery_date" class="col-sm-3 col-form-label">Delivery Date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="delivery_date" class="form-control" id="delivery_date"
                                       placeholder="Delivery Date" value="{{date("Y-m-d", strtotime($product->delivery_date))}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="min_reserved_price" class="col-sm-3 col-form-label">Min. Reserved Price</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="min_reserved_price" class="form-control" id="min_reserved_price"
                                       placeholder="Min. Reserved Price" value="{{$product->min_reserved_price}}">
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
                                  rows="3">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clearing_price" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-info" id="btn-product">Update</button>
                        </div>
                    </div>
                </div>
                <div class="col">

                    <div class="form-group row">
                        <label for="type" class="col-sm-3 col-form-label">Item</label>
                        <div class="col-sm-8">
                            {!! Form::select('item_id', $items, $product->item_id, ['placeholder' => 'Select a item', 'id' => 'item_id','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="closed_date" class="col-sm-3 col-form-label">Closed Date</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="closed_date" class="form-control" id="closed_date"
                                       placeholder="Closed Date" value="{{date("Y-m-d", strtotime($product->closed_date))}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="offer_quantity" class="col-sm-3 col-form-label">Total Offer</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="offer_quantity" class="form-control" id="offer_quantity"
                                       placeholder="Total Offer" value="{{$product->offer_quantity}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-6">
                            <?php $checkedStatus = (int) $product->status === 1 ? "checked" : ""; ?>
                            <label><input type="checkbox" name="status" <?php echo $checkedStatus?> class="flat-red">&nbsp;Active</label>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h3 class="card-title">Bid Status:</h3>
                </div>
                <div class="col-4">
                    Current Clearing Price: <span class="badge badge-pill badge-secondary">{{$product->clearingPrice->last()->clearing_price}}</span>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                @if(count($product->bids)<= 0)
                    <p>There is no bids</p>
                @else
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Bidder <span class="tooltip" title="This is my span's tooltip message!">
                                                    <i class="fa fa-info-circle"></i></span></th>
                            <th>Phone <span class="tooltip" title="This is my span's tooltip message!">
                                                    <i class="fa fa-info-circle"></i></span></th>
                            <th>Bid Price <span class="tooltip"
                                                title="This is my span's tooltip message!">
                                                    <i class="fa fa-info-circle"></i></span></th>
                            <th>Bid Qty <span class="tooltip"
                                              title="This is my span's tooltip message!">
                                                    <i class="fa fa-info-circle"></i></span></th>
                            <th>Winning Qty <span class="tooltip"
                                                  title="This is my span's tooltip message!">
                                                    <i class="fa fa-info-circle"></i></span></th>
                            <th>Date Time <span class="tooltip"
                                                title="Sets how often the tracker should run (see trackOrigin and trackTooltip), in milliseconds.">
                                                    <i class="fa fa-info-circle"></i></span></th>
                        </tr>
                        <?php $cSum = 0;?>
                        <?php $remainingQty =  $offerQty = $product->offer_quantity;?>
                        <?php $winningQty = 0;?>
                        @foreach($product->bids as $k => $v)
                            <?php $cSum += $v->bid_quantity;?>
                            <?php
                            if ($cSum <= $offerQty) {
                                $winningQty = $v->bid_quantity;
                                $remainingQty -= $v->bid_quantity;
                            } else {
                                if ($cSum > $offerQty && $remainingQty > 0) {
                                    $winningQty = $remainingQty;
                                } else {
                                    $winningQty = 0;
                                }
                                $remainingQty -= $winningQty;
                            }
                            ?>
                            <tr>
                                <td>{{$v->customer->first_name}} {{$v->customer->last_name}}</td>
                                <td>{{$v->customer->phone}}</td>
                                <td>{{$v->bid_price}}</td>
                                <td>{{$v->bid_quantity}}</td>
                                <td>{{$winningQty}}</td>
                                <td>{{date("F j, Y, g:i A", strtotime($v->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('footer')
    {!! Html::script("backend/js/product/product.js") !!}
@stop
