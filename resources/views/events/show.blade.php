<div class="container" id="conten">
    <div></div>
    <div class="row">
        <div class="card col-md-12 col-xl-8">
            <div class="row">
                <h1 class="col-xs-10 col-md-9 col-sm-12 col-xs-12">{{ $event['name'] }}</h1>
                @if(Auth::check() && $user->isMyEvent($event))
                    <div class="col-xl-2 col-md-3 col-sm-12 col-xs-12 d-flex justify-content-center"
                         role="group" aria-label="Basic example">
                        <a class="btn btn-outline-info col-12" href="{{ url('/') }}/events/{{$event['id']}}/edit"
                           data-toggle="tooltip" data-placement="top" title="Editar datos del usuario">Editar evento</a>
                        <form class="col-12" action="{{route('event.delete',array('id' => $event['id']))}}"
                              method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-outline-info" data-toggle="tooltip"
                                    data-placement="top" title="Borrar al usuario">Eliminar evento
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-4 img-princ"><img src="{{ $event['image'] }}"></div>

                <div class="col-md-4">
                    <p>Fecha: <strong>{{ $event['date'] }}</strong></p>
                    <p>Duracion: <strong>{{ $event['duration'] }}</strong></p>
                    <p>Edad minima: <strong>{{ $event['agemin'] }}</strong></p>
                </div>

                <div class="col-md-4">
                    <input id="costEvent" type="hidden" class="form-control" name="cost" value="{{ $event['cost'] }}"
                           readonly>
                    <p>Precio: <strong>{{ $event['cost'] }}</strong></p>
                    <p>Organizador: <strong>{{ $event['organizer'] }}</strong></p>
                    @if(Auth::check() && !Auth::user()->isMyEvent($event))
                        @if(Auth::user()->ReserveEvent($event))
                            <form action="{{ url('/') }}/factura" method="post">
                                {{ csrf_field() }}

                                <input id="event_id" type="hidden" name="event_id"
                                       value="{{ $event['id'] }}">
                                <button id="reserva_Factura" class="btn btn-outline-info" data-toggle="tooltip"
                                        data-placement="top" title="Descargar pdf de factura de la reserva">
                                    Descargar Factura
                                </button>
                            </form>
                            <a class="btn btn-outline-info" href="{{ url('/') }}/reserves/{{$event->ReserveEventUser()->id}}/edit" data-toggle="tooltip" data-placement="top"
                               title="Editar datos del usuario">Editar Reserva</a>
                            <form action="{{route('reserve.delete',array('id' => $event['id']))}}"
                                  method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-outline-info" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Borrar al usuario">Eliminar Reserva
                                </button>
                            </form>
                        @else
                            <button id="abrirReserva" class="btn btn-outline-info" data-toggle="tooltip"
                                    data-placement="top" title="Reservar unas plazas para el evento">
                                Reservar
                            </button>
                        @endif
                    @endif
                    <div class="iziModal">
                        <div id="reserva" class="row justify-content-md-center mt-5">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Añadir Reserva</div>

                                    <div class="card-body">
                                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/reserves/create"
                                              method="post" enctype="multipart/form-data" id="formReserve">
                                            {{ csrf_field() }}

                                            <input id="event_id" type="hidden" name="event_id"
                                                   value="{{ $event['id'] }}">

                                            <div class="form-group">
                                                <label for="place" class="col-md-4 control-label">Lugar
                                                    evento</label>
                                                <input class="form-control" name="place" id="place"
                                                       value="{{ $place['name'] }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="fecha" class="col-md-4 control-label">Fecha
                                                    evento</label>
                                                <input class="form-control" name="fecha" id="fecha"
                                                       value="{{ $event['date'] }}" readonly>
                                            </div>

                                            <div class="form-group{{ $errors->has('units') ? ' has-error' : '' }}">
                                                <label for="unidad"
                                                       class="col-md-4 control-label">Unidades</label>
                                                <div></div>
                                                <input id="unidad" type="text" class="form-control"
                                                       name="unidad"
                                                       value="{{ old('units') }}">

                                                @if($errors->has('units'))
                                                    @foreach($errors->get('units') as $message)
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="cost" class="col-md-4 control-label">Precio
                                                    entrada</label>
                                                <input id="cost" class="form-control" name="cost" readonly>
                                            </div>

                                            <div class="form-group">
                                                <button id="createReserve" type="submit"
                                                        class="btn btn-info text-light">
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
                <div class="col-md-12">
                    <p>Temas del evento:
                        <strong>
                            @forelse($event->SubjectEvent() as $subject)
                                <a href="{{ url('/') }}/subjects/{{ $subject }}"
                                   class="badge badge-info text-white">{{ $subject }}</a>
                            @empty
                                <h3>No hay tiene ningun tema</h3>
                            @endforelse

                            @if(count($event->SubjectEvent()) < 8 && Auth::check() && Auth::user()->isMyEvent($event) )
                                <form>
                                    <button id="abrirReserva" class="btn btn-outline-info" data-toggle="tooltip"
                                            data-placement="top" title="Añade o crea un tema nuevo al usuario">
                                        Añadir tema
                                    </button>
                                </form>
                            @endif
                        </strong>
                    </p>
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
                    <div class="col-xl-7 col-sm-8 col-md-12">
                        <h4>Radio votacion</h4>
                        <div class="votos">
                            <div>5 <img class="estrella" src="../estrellas.png"/></div>
                            <div id="progress5"
                                 class="progress progress-bar bg-success progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 style="width: @if($event->votesCalculator(5)*100 >= 5) {{ $event->votesCalculator(5)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(5)*100) }}
                                %
                            </div>
                        </div>
                        <div class="votos">
                            <div>4 <img class="estrella" src="../estrellas.png"/></div>
                            <div id="progress4"
                                 class="progress progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 style="width: @if($event->votesCalculator(4)*100 >= 5) {{ $event->votesCalculator(4)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(4)*100) }}
                                %
                            </div>
                        </div>
                        <div class="votos">
                            <div>3 <img class="estrella" src="../estrellas.png"/></div>
                            <div id="progress3"
                                 class="progress progress-bar bg-info progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 style="width: @if($event->votesCalculator(3)*100 >= 5) {{ $event->votesCalculator(3)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(3)*100) }}
                                %
                            </div>
                        </div>
                        <div class="votos">
                            <div>2 <img class="estrella" src="../estrellas.png"/></div>
                            <div id="progress2"
                                 class="progress progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 style="width: @if($event->votesCalculator(2)*100 >= 5) {{ $event->votesCalculator(2)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(2)*100) }}
                                %
                            </div>
                        </div>
                        <div class="votos">
                            <div>1 <img class="estrella" src="../estrellas.png"/></div>
                            <div id="progress1"
                                 class="progress progress-bar bg-danger progress-bar-striped progress-bar-animated"
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
                    <h2 class="col-md-4 col-xl-12">{{ $place['name'] }}</h2>
                    <input id="latitud" type="hidden" value="{{explode(", ", $place['coordinate'])[0]}}">
                    <input id="longitud" type="hidden" value="{{explode(", ", $place['coordinate'])[1]}}">
                    <div id="map" class="mapsmall col-md-8 col-xl-12"></div>
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
                @if(count($commentarys) == 10)
                    <div class="col-md-12 course-set courses__row event">
                        <h3 class="card text-info" id="allcommentarys">
                            Mostrar todos los comentarios
                        </h3>
                    </div>
                @endif
            @endif
        </div>
    @endif
</div>

@push('scripts')
    <script src="{{ asset('js/show.js') }}" defer></script>
    <script>
        $(function () {
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush