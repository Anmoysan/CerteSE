@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/events/">Proximos eventos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Evento</li>
@endsection

@section('content')
    <div id="contenedor">
        @include('events.show')
    </div>
@endsection