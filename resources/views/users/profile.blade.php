@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
@endsection

@section('content')
    <div>
        <div class="btn-group container d-flex justify-content-between" role="group">
            <button type="button" id="infoUser" class="btn btn-primary text-white col-md-4" data-toggle="tooltip" data-placement="bottom" title="Datos personales del usuario">Informacion</button>
            <button type="button" id="eventsUser" class="btn btn-primary text-white col-md-4" data-toggle="tooltip" data-placement="bottom" title="Eventos creados por el usuario">Eventos creados</button>
            <button type="button" id="invoicesUser" class="btn btn-primary text-white col-md-4" data-toggle="tooltip" data-placement="bottom" title="Facturas de las diferentes reservas del usuario">Facturas</button>
        </div>

        <div id="dateProfile" class="container perfil card">
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/paginationMyEvents.js') }}" defer></script>
@endpush