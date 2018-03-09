@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Error 500</li>
@endsection

@section('content')
    <div class="text-center">
        <img class="img-responsive img-fluid img-portfolio img-hover imagenevent" src="{{ asset('500.gif') }}">
        <h1>¿Que has roto ahora?</h1>
    </div>
@endsection