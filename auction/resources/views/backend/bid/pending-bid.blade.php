@extends('backend.layouts.app')

@section('page-header')
    <h1 class="m-0 text-dark">
        Bids
    </h1>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active">Bids</li>
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">New Bid List:</h3>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="pending-bids" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="padding-right: 5px">SN</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Bid Qty</th>
                        <th>Bid Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('backend.bid.status-model')
@endsection

@section('footer')
    {!! Html::script("backend/js/bid/bidList.js") !!}
    {!! Html::script("backend/js/bid/bid.js") !!}
@stop
