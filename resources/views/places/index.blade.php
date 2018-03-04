@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lugares</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-header titulo">Lugares</h1>
            </div>
        </div>
        @forelse($places->chunk(3) as $chunk)
            <div class="row course-set courses__row event d-flex justify-content-around">
                @foreach($chunk as $place)
                    @include('places.place')
                @endforeach
            </div>
        @empty
            <h1>No hay lugares todavia</h1>
        @endforelse

        <div class="pagination">
            {{ $places->links('pagination::bootstrap-4') }}
        </div>

    </div>

@endsection