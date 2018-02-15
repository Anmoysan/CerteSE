@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-header titulo">Proximos eventos</h1>
            </div>
        </div>
        <div id="listado" >
            @include('events.listaevents')
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/pagination.js') }}" defer></script>
@endpush