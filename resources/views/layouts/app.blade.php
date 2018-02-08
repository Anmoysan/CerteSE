<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="../../../node_modules/leaflet/dist/leaflet.css"
          integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
          crossorigin=""/>
</head>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.44.0/mapbox-gl.css' rel='stylesheet'/>
<script src="../../../node_modules/leaflet/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('Logo.png') }}" id="logo"/></a>
            <a class="navbar-brand text-success" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            @if( Auth::check())
                @if(App\Place::count() > 0)
                    <a class="navbar-brand text-success" href="{{ url('/') }}/events/create">Crear Eventos</a>
                @endif
                <a class="navbar-brand text-success" href="{{ url('/') }}/places/create">Crear Lugar</a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-brand"><a href="{{ route('login') }}" class="nav-link text-success">Login</a>
                        </li>
                        <li class="nav-brand"><a href="{{ route('register') }}"
                                                 class="nav-link text-success">Registrar</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-success" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ url('/') }}/profile" class="dropdown-item nav-brand text-success">Perfil</a>
                                <a href="{{ route('logout') }}" class="dropdown-item nav-brand text-success"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
    <div class="contenido">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
</body>
</html>
