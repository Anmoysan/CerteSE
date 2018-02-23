@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-12 col-xl-8">
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
                        <input id="costEvent" type="hidden" class="form-control" name="cost" value="{{ $event['cost'] }}" readonly>
                        <p>Precio: <strong>{{ $event['cost'] }}</strong></p>
                        <p>Organizador: <strong>{{ $event['organizer'] }}</strong></p>
                        @if(Auth::check())<button @if(Auth::user()->ReserveEvent($event)) id="reserva_Factura" @else id="abrirReserva" @endif class="btn btn-outline-info">@if(Auth::user()->ReserveEvent($event)) Descargar Factura @else Reservar @endif</button>@endif
                        <div class="iziModal">
                            <div id="reserva" class="row justify-content-md-center mt-5">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">Añadir Reserva</div>

                                        <div class="card-body">
                                            <form action="{{ url('/') }}/events/{{ $event['id'] }}/reserves/create" method="post">
                                                {{ csrf_field() }}

                                                <input id="event_id" type="hidden" name="event_id" value="{{ $event['id'] }}">

                                                <div class="form-group">
                                                    <label for="place" class="col-md-4 control-label">Lugar evento</label>
                                                    <input class="form-control" name="place" id="place" value="{{ $place['name'] }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="date" class="col-md-4 control-label">Fecha evento</label>
                                                    <input class="form-control" name="date" id="date" value="{{ $event['date'] }}" readonly>
                                                </div>

                                                <div class="form-group{{ $errors->has('units') ? ' has-error' : '' }}">
                                                    <label for="units" class="col-md-4 control-label">Unidades</label>
                                                    <input id="units" type="number" class="form-control" name="units" value="{{ old('units') }}">
                                                    @if($errors->has('units'))
                                                        @foreach($errors->get('units') as $message)
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ $message }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="cost" class="col-md-4 control-label">Precio entrada</label>
                                                    <input id="cost" class="form-control" name="cost" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <button id="createReserve" type="submit" class="btn btn-info text-light">
                                                        Añadir Reserva
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-xl-5 col-md-12">
                            <div>
                                <h4>Media votacion</h4>
                                <h2 class="bold padding-bottom-7">{{ number_format($votesTotal, 2, '.', '') }}
                                    <small>/ 5</small>
                                </h2>

                                @if( Auth::check() && !Auth::user()->isMyEvent($event) )
                                    <div class="row">
                                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/votes/create"
                                              method="post">
                                            {{ csrf_field() }}
                                            <input id="event_id" type="hidden" name="event_id"
                                                   value="{{ $event['id'] }}">
                                            <input id="vote" type="hidden" name="vote" min="1" max="5">

                                            <h4 class="col-md-12">
                                                @if(!Auth::user()->VoteEvent($event))Votar el evento @else Modificar
                                                el voto @endif: </h4>
                                            <button type="submit" href="" id="estrella1" class="btn votar"
                                                    aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella2" class="btn votar"
                                                    aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella3" class="btn votar"
                                                    aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella4" class="btn votar"
                                                    aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella5" class="btn votar"
                                                    aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-xl-7 col-md-12">
                            <h4>Radio votacion</h4>
                            <div class="votos">
                                <div>5 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-success progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: @if($event->votesCalculator(5)*100 >= 5) {{ $event->votesCalculator(5)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(5)*100) }}
                                    %
                                </div>
                            </div>
                            <div class="votos">
                                <div>4 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: @if($event->votesCalculator(4)*100 >= 5) {{ $event->votesCalculator(4)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(4)*100) }}
                                    %
                                </div>
                            </div>
                            <div class="votos">
                                <div>3 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-info progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: @if($event->votesCalculator(3)*100 >= 5) {{ $event->votesCalculator(3)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(3)*100) }}
                                    %
                                </div>
                            </div>
                            <div class="votos">
                                <div>2 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: @if($event->votesCalculator(2)*100 >= 5) {{ $event->votesCalculator(2)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(2)*100) }}
                                    %
                                </div>
                            </div>
                            <div class="votos">
                                <div>1 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-danger progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: @if($event->votesCalculator(1)*100 >= 5) {{ $event->votesCalculator(1)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(1)*100) }}
                                    %
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-md-12 col-xl-4">
                <div class="row pagination">
                    <h1>Lugar</h1>
                    <div id="mapLugar" class="row">
                        <h2>{{ $place['name'] }}</h2>
                        <div id="map" class="mapsmall"></div>
                    </div>
                </div>
            </div>
        </div>

        @if($event['commentarys'] == true || $event['commentarys'] == 1)
            <div class="row card">
                <h2>Comentarios</h2>
                <hr>
                <div class="">
                    @include('commentarys.newCommentary')
                </div>
                @if($commentarys == null)
                    <p>No hay ningun comentario todavia</p>
                @else
                    @foreach($commentarys as $commentary)
                        <div class="col-md-12 course-set courses__row event">
                            <div class="card">
                                @include('commentarys.commentary')
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/votes.js') }}" defer></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
    <script>
        $(function () {
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush