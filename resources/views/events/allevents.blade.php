@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Proximos eventos</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1 class="page-header titulo">{{$titulo}}</h1>
                <div id="listado">
                    @include('events.listaevents')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/paginationEvents.js') }}" defer></script>
@endpush