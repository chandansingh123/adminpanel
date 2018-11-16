<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Saral Nilami') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/frontend/img/logo.png">
    <link rel="stylesheet" href="{{ asset('assets/css/thumbnail-gallery.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/css/modern-business.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css" />
    {!! Html::style('frontend/css/smart_wizard_theme_arrows.css') !!}
    {!! Html::style('frontend/css/style.css') !!}
    @yield('head')
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@include('frontend.includes.header')
@if (Request::path() == '/')
    @include('frontend.includes.carousel')
@endif

<div class="main">
    
        @yield('content')
</div>

@include('frontend.includes.footer')

<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{!! Html::script("backend/js/vendor/jquery.maskedinput.js") !!}
{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}
{!! Html::script("backend/js/vendor/jquery.validate.min.js") !!}
{!! Html::script("backend/js/vendor/additional-methods.min.js") !!}
{!! Html::script("frontend/js/jquery.smartWizard.min.js") !!}
{!! Html::script("backend/js/vendor/jquery.blockUI.js") !!}
{!! Html::script("backend/js/utils/common.js") !!}

@yield('footer')

</body>
</html>