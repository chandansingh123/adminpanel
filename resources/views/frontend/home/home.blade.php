@extends('frontend.layouts.app')

@section('content')
<div class="container">
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

    @include('frontend.home.item')
</div>
@include('frontend.home.activity')
<div class="container">
    @include('frontend.home.member')
    @include('frontend.home.gallery')
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