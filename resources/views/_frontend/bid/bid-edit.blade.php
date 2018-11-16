@extends('_frontend.layouts.app')

@section('content')
<section class="page-header page-header-custom-background" style="margin-top: 100px">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> Manage Bid</span></h1>
      </div>
      <div class="col-lg-6">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="#">Bid</a></li>
                <li><a href="/mybids">My Bid</a></li>
            </ul>
      </div>
    </div>
  </div>
</section>

<div class="container">

    <section>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="clearing_price" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <span class="badge badge-pill badge-secondary">{{$bid->product->name}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clearing_price" class="col-sm-4 col-form-label">Delivery Date</label>
                    <div class="col-sm-8">
                        <span class="badge badge-pill badge-secondary">{{date("Y-m-d", strtotime($bid->product->delivery_date))}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clearing_price" class="col-sm-4 col-form-label">Total Offer</label>
                    <div class="col-sm-8">
                        <span class="badge badge-pill badge-secondary">{{$bid->product->offer_quantity}}</span>
                        <span>KG.</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="clearing_price" class="col-sm-4 col-form-label">Min. Reserved Price</label>
                    <div class="col-sm-8">
                        <span class="badge badge-pill badge-secondary">{{$bid->product->min_reserved_price}}</span>
                        <span>RS.</span>
                    </div>
                </div>

                {!! Form::open(['class' => 'form-horizontal','id' => 'bid-edit-form', 'url'=>'mybid/amend', 'role' => 'form', 'method' => 'POST']) !!}
                {!! Form::hidden('id', $bid->id , array('id' => 'id')) !!}
                {!! Form::hidden('product_id', $bid->product_id , array('id' => 'product_id')) !!}
                {!! Form::hidden('customer_id', Auth::user()->id , array('id' => 'customer_id')) !!}
                {!! Form::hidden('status', $bid->status , array('id' => 'status')) !!}

                <div class="form-group row">
                    <label for="bid_price" class="col-sm-4 col-form-label">Price</label>
                    <div class="col-sm-8">
                        <input type="text" name="bid_price" class="form-control" id="bid_price"
                               placeholder="Price" value="{{$bid->bid_price}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bid_quantity" class="col-sm-4 col-form-label">Quantity</label>
                    <div class="col-sm-8">
                        <input type="number" name="bid_quantity" class="form-control" id="bid_quantity"
                               placeholder="Quantity" value="{{$bid->bid_quantity}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quantity" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-info btn-block btn-flat">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('head')

@stop

@section('footer')
    {!! Html::script("frontend/js/bid/bid.js") !!}
@stop