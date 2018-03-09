@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Error 502</li>
@endsection

@section('content')
    <div class="text-center">
        <img class="img-responsive img-fluid img-portfolio img-hover imagenevent" src="{{ asset('502.gif') }}">
        <h1>Ufff, si que tarda</h1>
    </div>
@endsection