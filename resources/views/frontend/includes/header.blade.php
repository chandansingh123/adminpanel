<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark saralurja-hd">
    <div class="container">
    <div class="header-column">
    <div class="header-row">
        <a class="navbar-brand" href="/">
              <span class="logo-area">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="Logo">
              </span>
        </a>
        </div>
        </div>
        <div class="header-column  justify-content-end">
        <!-- Weather Status -->
            <div class="header-row pt-3 weather-status">
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Raksirang, Makawanpur
                        <img src="{{$weather->weather->getIconUrl()}}" class="icon-weather" alt="Wheather of Raksirang, Makawanpur">
                        <span>{{html_entity_decode($weather->temperature->now)}}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="weather-details">
                            <li>Today {{date("l, F j Y")}}</li>
                            <li>{{ucfirst($weather->weather->description)}}</li>
                            <li>Precipation: {{$weather->precipitation}}</li>
                            <li>Humidity: {{$weather->humidity}}</li>
                            <li>Wind: {{$weather->wind->speed}}</li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- Weather Status -->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
         
        <div class="collapse navbar-collapse" id="navbarResponsive">
           
            <ul class="navbar-nav auction-meenu ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/aboutus">About Us</a>
                </li>
                @if(Auth::guard('web')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="/mybids">My Bids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/signup"><i class="fa fa-user"></i> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fa fa-key"></i> Login</a>
                    </li>
                @endif
            </ul>
        </div>
        </div>
    </div>
</nav>