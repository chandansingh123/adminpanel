@extends('frontend.layouts.app')

@section('content')

    {{--<div class="row" style="margin-bottom: 30px;">--}}
    {{--<div class="col-12">--}}
    {{--<p class="my-4" style="text-align: center;">Project Progress Bar</p>--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="{{$project->progress}}"--}}
    {{--aria-valuemin="0" aria-valuemax="100">{{$project->progress}}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <!-- Features Section -->
    <div class="row">
        <div class="col-lg-4">
            <h3>{{$item->name}}</h3>

            <div class="card white" style="border: none;">
                <div class="card-block p-25">
                    <h5 class="white">
                        <span>Raksirang, </span>Makawanpur
                    </h5>
                    <p class="weather-day-date mb-30">
                        <span style="font-weight: bold;">Today</span> {{date("l, F j Y")}}
                    </p>
                    <div class="mb-30 text-center">
                        <img src="{{$weather->weather->getIconUrl()}}"/>
                        <div class="inline-block">
                      <span class="font-size-50">{{html_entity_decode($weather->temperature->now)}}
                      </span>
                            <p>{{ucfirst($weather->weather->description)}}</p>
                            <p>Precipation: {{$weather->precipitation}}</p>
                            <p>Humidity: {{$weather->humidity}}</p>
                            <p>Wind: {{$weather->wind->speed}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            {!! Html::image('/uploads/items/'.$item->file_name, 'Item Image', array('class' => 'img-fluid rounded', 'style' => "padding-bottom: 10px;")) !!}
            <p>{{$item->description}}</p>
            <a href="/aboutus" class="btn btn-info">Read More →</a>
        </div>
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="bid-now" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-6">
                    <a href="/bidnow" class="btn btn-info">BID NOW</a>
                </div>
            </div>


            <div class="card" style="border: none;">
                <h5 class="card-header"
                    style="padding: .0rem 1.25rem .20rem 0;background-color:none;background-color: rgba(0,0,0,0);">TOP
                    BIDS</h5>
                <div class="card-body" style="padding: 0px;">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td>Offer 1</td>
                            <td>12</td>
                            <td>RS. 5000</td>
                        </tr>
                        <tr>
                            <td>Offer 1</td>
                            <td>12</td>
                            <td>RS. 5000</td>
                        </tr>
                        <tr>
                            <td>Offer 1</td>
                            <td>12</td>
                            <td>RS. 5000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    {{--<hr>--}}

    {{--<div class="row" style="margin-bottom: 30px;">--}}
    {{--<div class="col-lg-4">--}}
    {{--<h2>Forecast Output</h2>--}}
    {{--<p>Date Range</p>--}}
    {{--<form name="sentMessage" id="contactForm" novalidate>--}}
    {{--<div class="control-group form-group">--}}
    {{--<div class="controls">--}}
    {{--<label>From:</label>--}}
    {{--<div class="input-group mb-3">--}}
    {{--<input type="text" class="form-control" name="from_date" placeholder="From Date">--}}
    {{--<div class="input-group-append">--}}
    {{--<span class="input-group-text" id="basic-addon2"><i--}}
    {{--class="fa fa-calendar-alt"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="control-group form-group">--}}
    {{--<div class="controls">--}}
    {{--<label>To:</label>--}}
    {{--<div class="input-group mb-3">--}}
    {{--<input type="text" class="form-control" name="to_date" placeholder="To Date">--}}
    {{--<div class="input-group-append">--}}
    {{--<span class="input-group-text" id="basic-addon2"><i--}}
    {{--class="fa fa-calendar-alt"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--<span>--}}
    {{--<a href="/history" class="btn btn-info">See history details →</a>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--<div class="col-lg-8">--}}
    {{--<div class="tab-content p-0">--}}
    {{--<!-- Morris chart - Sales -->--}}
    {{--<div class="chart tab-pane active" id="revenue-chart"--}}
    {{--style="position: relative; height: 300px;"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /.row -->

    <hr>

    <h2>Our Activities</h2>
    <div class="row" style="margin-bottom: 30px;">
        @include('frontend.home.activity')
    </div>


    <hr>
    <!-- Team Members -->
    <h2>Our Members</h2>
    <div class="row" style="margin-bottom: 30px;">
        @include('frontend.home.member')
    </div>


    <hr>

    <h2>Gallery</h2>
    <div class="row" style="margin: 0 15px 30px 15px;">
        @include('frontend.home.gallery')
    </div>

    </div>

@endsection

@section('footer')
    <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.min.js"></script>
    {!! Html::script("frontend/js/home/home.js") !!}
@stop

@section('head')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css"/>
@stop