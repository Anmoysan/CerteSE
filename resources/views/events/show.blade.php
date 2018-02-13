@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <h1>{{ $event['name'] }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-4 img-princ"><img src="{{ $event['image'] }}"></div>

                    <div class="col-md-4">
                        <p>Fecha: <strong>{{ $event['date'] }}</strong></p>
                        <p>Duracion: <strong>{{ $event['duration'] }}</strong></p>
                        <p>Edad minima: <strong>{{ $event['agemin'] }}</strong></p>
                    </div>

                    <div class="col-md-4">
                        <p>Precio: <strong>{{ $event['cost'] }}</strong></p>
                        <p>Organizador: <strong>{{ $event['organizer'] }}</strong></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">Votacion: {{ $votesTotal }}/5</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row pagination">
                    <h1>Lugar</h1>
                    <div class="row">
                        <h2>{{ $place['name'] }}</h2>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        @if($event['commentarys'] == true || $event['commentarys'] == 1)
            <div class="row">
                <h2>Comentarios</h2>
                @if($commentarys == null)
                    <p>No hay ningun comentario todavia</p>
                @else
                    @foreach($commentarys as $commentary)
                        <div class="col-md-12 course-set courses__row event">
                            @include('commentarys.commentary')
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script >
        $(function(){
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush