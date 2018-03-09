@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class=" page-header titulo">Eventos que te podrian interesar</h1>
            </div>
        </div>
        <div id="listado" >
            @include('events.listaevents')
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/paginationEventsMySubject.js') }}" defer></script>
@endpush