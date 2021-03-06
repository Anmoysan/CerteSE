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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"/>
    <link href="{{ asset('css/iziModal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="{{ asset('css/icono.min.css') }}">
</head>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.44.0/mapbox-gl.css' rel='stylesheet'/>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-link" href="{{ url('/') }}"><img src="{{ asset('Logo.png') }}" id="logo"/></a>
        <div class="container collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-link text-info"
                       href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </li>


                <li class="nav-brand dropdown">
                    <a class="navbar-link text-info dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Eventos</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="navbar-link dropdown-item text-info" href="{{ url('/') }}/events/">Ver</a>

                        @if(Auth::check() && App\Place::count() > 0)
                            <a class="navbar-link dropdown-item text-info" href="{{ url('/') }}/events/create">Crear</a>
                        @endif
                    </div>
                </li>

                <li class="nav-brand dropdown">
                    <a class="navbar-link text-info dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Lugares</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="navbar-link dropdown-item text-info" href="{{ url('/') }}/places/">Ver</a>
                        @if( Auth::check())
                            <a class="navbar-link dropdown-item text-info" href="{{ url('/') }}/places/create">Crear</a>
                        @endif
                    </div>
                </li>
                @yield('nav')
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-brand"><a href="{{ route('login') }}" class="nav-link text-info">Login</a>
                        </li>
                        <li class="nav-brand"><a href="{{ route('register') }}"
                                                 class="nav-link text-info">Registrar</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-info" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ url('/') }}/profile" class="dropdown-item nav-brand text-info">Perfil</a>
                                <a href="{{ url('/') }}/profile/configuration"
                                   class="dropdown-item nav-brand text-info">Configurar Perfil</a>
                                <a href="{{ route('logout') }}" class="dropdown-item nav-brand text-info"
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb container">
                @yield('breadcrumb')
            </ol>
        </nav>
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js'></script>
<script src="{{ asset('js/iziModal.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.js" type="text/javascript"></script>
<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
@stack('scripts')
</body>
</html>
