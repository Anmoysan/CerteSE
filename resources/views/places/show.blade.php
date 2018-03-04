@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/places/">Lugares</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lugar</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('places.placeall')
            </div>
        </div>
    </div>
@endsection