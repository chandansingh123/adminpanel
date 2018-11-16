@extends('_frontend.layouts.app')
@section('content')
<section class="page-header page-header-custom-background" style="margin-top: 100px;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> My Bid (s)</span></h1>
    </div>
    <div class="col-lg-6">
        <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/mybids">My Bid</a></li>
        </ul>
    </div>
</div>
</div>
</section>

<div class="container">

    <div class="alert alert-success bid-success-message" style="display: none"></div>

    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if(count($bids)<= 0)
    <div class="alert alert-danger">There is no bids. Back to <a href="/">homepage</a></div>
    @else
    <!-- Bidding List -->
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Delivery Date</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bids as $bid)
                <tr>
                    <td>{{$bid->product->name}}</td>
                    <td>{{date("Y-m-d", strtotime($bid->product->delivery_date))}}</td>
                    <td>{{$bid->bid_quantity}}</td>
                    <td>{{$bid->bid_price}}</td>
                    <td>{{$bid->total_price}}</td>
                    <td>{!!$bid->status_label!!}</td>
                    <td class="btn-groups">{!! ($bid->status == 3 || $bid->product->closed_date <= date("Y-m-d H:i:s") ) ? '' : '<a href="/bid/edit/'.$bid->id.'" title="Edit"><i class="fa fa-edit"></i> Edit</a>   <a href="javascript:void(0);" class="bid-cancel-btn"  data-toggle="modal" data-target="#bidCancelModal" title="Cancel" data-id="'.$bid->id .'"><i class="fa fa-times"></i> Delete</a>'!!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    
    @endsection

    @section('head')

    @stop

    @section('footer')
    {!! Html::script("frontend/js/bid/bid.js") !!}
    @stop
</div>
@section('script')
@endsection