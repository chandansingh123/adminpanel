@extends('frontend.layouts.app')

@section('content')
<section class="page-header page-header-custom-background">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1><span> My Bid</span></h1>
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

         @if(count($products) <= 0)
                <div class="alert alert-danger">There is no products on this item. Back to <a href="/">homepage</a></div>
            @else

        <div id="smartwizard">           
            <ul>
                @foreach($products as $key => $val)
                    <li><a href="#step-{{$key}}">Delivery Date: {{date("Y-m-d", strtotime($val->delivery_date))}}<br/>
                            <small>{{$val->name}}</small>
                        </a></li>
                @endforeach
            </ul>

            <div>
                @foreach($products as $key => $val)
                    <div id="step-{{$key}}" class="">
                        <div class="row" style="padding: 20px;">
                            <div class="col-8">

                                <h4>Description</h4>
                                <p>{{$val->description}}</p>
                                <hr>

                                <h4>Bid Status</h4>
                                @if(count($val->bids)<= 0)
                                    <div class="alert alert-danger">There is no bids</div>
                                @else
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th>Bidder <span class="tooltip" title="This is my span's tooltip message!">
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
                                        <?php $remainingQty = $val->offer_quantity;?>
                                        <?php $winningQty = 0;?>
                                        <?php $offerQty = $val->offer_quantity;?>
                                        @foreach($val->bids as $k => $v)
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
                                            <tr class='{{($v->customer_id== Auth::user()->id) ? "my-bid" : ""}}'>
                                                <td>{{($v->customer_id== Auth::user()->id) ? "My Bid" : "Bidder #".($k+1)}}</td>
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
                            <div class="col-4">
                                <div class="form-group">
                                    <div data-countdown="{{$val->closed_date}}" class="timerwrap alert alert-warning"></div>
                                </div>

                                <ul class="list-group sn-bid-status">

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Current Clearing Price (RS.)
                                            <span class="badge badge-primary badge-pill">{{ $val->clearingPrice->last()->clearing_price}}</span>
                                        
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Total Offer (KG.)
                                            <span class="badge badge-primary badge-pill">{{$val->offer_quantity}}</span>
                                        
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Min. Reserved Price (RS.)
                                            <span class="badge badge-primary badge-pill">{{$val->min_reserved_price}}</span>
                                        
                                </li>
                                </ul>

                                @if(date("Y-m-d", strtotime($val->closed_date)) <= date("Y-m-d"))
                                    <div class="alert alert-danger" role="alert">
                                        The AUCTION time expired on this product.
                                    </div>
                                @elseif($val->myBids)
                                    <div class="alert alert-info" role="alert">
                                        You have already bid on this product.
                                    </div>
                                    <a href="/mybids" class="btn btn-primary" role="button"> <i class="fa fa-gavel"></i> Go to My Bids</a>
                                @else
                                    {!! Form::open(['class' => 'form-horizontal','id' => 'bid-add-form', 'url'=>'bid/store', 'role' => 'form', 'method' => 'POST']) !!}
                                    {!! Form::hidden('product_id', $val->id , array('id' => 'product_id')) !!}
                                    {!! Form::hidden('customer_id', Auth::user()->id , array('id' => 'customer_id')) !!}

                                    <div class="form-group row">
                                        <label for="bid_price" class="col-sm-4 col-form-label">Price</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="bid_price" class="form-control" id="bid_price"
                                                   placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bid_quantity" class="col-sm-4 col-form-label">Quantity</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="bid_quantity" class="form-control"
                                                   id="bid_quantity"
                                                   placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quantity" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info btn-block btn-flat">Submit
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
@endsection
</div>
@section('head')
    <link href="{{ asset('plugins/tooltipster/dist/css/tooltipster.bundle.min.css') }}" rel="stylesheet">
@stop

@section('footer')
    {!! Html::script("frontend/js/jquery.countdown.min.js") !!}
    {!! Html::script("frontend/js/bid/bid.js") !!}
    {!! Html::script("plugins/tooltipster/dist/js/tooltipster.bundle.min.js") !!}

    <script type="text/javascript">
        $(document).ready(function () {

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                transitionEffect: 'fade',
                showStepURLhash: false,
                toolbarSettings: {
                    toolbarPosition: 'none'
                },
                anchorSettings: {
                    enableAllAnchors: true, // Activates all anchors clickable all times
                }
            });

            $('[data-countdown]').each(function () {
                var $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    $this.html(event.strftime(''
//                            '%D Days %H Hrs %M Mins %S Secs'
                            + '<ul class="timer-box"><li><span>%D </span>Days</li> '
                            + '<li><span>%H </span>Hrs</li> '
                            + '<li><span>%M </span>Mins</li> '
                            + '<li><span>%S </span>Secs</li> </ul> '
                    ));
                });
            });

        });
    </script>
@stop