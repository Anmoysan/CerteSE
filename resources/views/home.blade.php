@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="page-header">Eventos</h1>
            </div>
        </div>
    </div>
    @forelse($events->chunk(3) as $chunk)
        <div class="row course-set courses__row event">
            @foreach($chunk as $event)
                <div class="col-md-4">
                    <div class="ng">
                        <h3>
                            {{ $event['name'] }}
                        </h3>
                    </div>

                    <div>
                        <img class="img-princ img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent"
                             src="{{ $event['image'] }}" alt="Foto del producto."/>
                    </div>

                    <div>
                        <h4 class="price ng">
                            Precio: {{ $event['cost'] }} €
                        </h4>
                    </div>
                    <div>
                        <p class="ng">
                            Fecha: {{ $event['date'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <h1>No hay eventos programados todavia</h1>
    @endforelse

    <div class="text-center"></div>

@endsection