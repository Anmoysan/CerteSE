@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1 class="page-header titulo">Proximos eventos</h1>
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