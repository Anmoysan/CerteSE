@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Error 404</li>
@endsection

@section('content')
    <div class="text-center">
        <img class="img-responsive img-fluid img-portfolio img-hover imagenevent" src="{{ asset('404.gif') }}">
        <h1>No se encontro lo que querias</h1>
    </div>
@endsection