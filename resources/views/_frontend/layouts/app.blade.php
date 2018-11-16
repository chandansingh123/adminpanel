<!DOCTYPE html>
<head>
    @include('_frontend.includes.head')
    @yield('style')
</head>
<body>
    @include('_frontend.includes.preloader')
    <div class="culmn">
        @include('_frontend.includes.header')   
        @yield('content')  
    </div>
    @include('_frontend.includes.footer') 
    @include('_frontend.includes.foot')
    @yield('script')
</body>
</html>

