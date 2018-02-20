@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-8">
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

                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <div>
                                <h4>Media votacion</h4>
                                <h2 class="bold padding-bottom-7">{{ number_format($votesTotal, 2, '.', '') }}
                                    <small>/ 5</small>
                                </h2>

                                @if( Auth::check() && !Auth::user()->isMyEvent($event) )
                                    <div>
                                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/votes/create" method="post">
                                            {{ csrf_field() }}

                                            <input id="event_id" type="hidden" name="event_id" value="{{ $event['id'] }}">
                                            <input id="vote" type="hidden" name="vote" min="1" max="5">

                                            <h4 class="row">Votar: </h4>
                                            <button type="submit" href="" id="estrella1" class="btn votar" aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella2" class="btn votar" aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella3" class="btn votar" aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella4" class="btn votar" aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                            <button type="submit" id="estrella5" class="btn votar" aria-label="Left Align">
                                                <img class="estrella" src="../estrellas.png"/>
                                            </button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4>Radio votacion</h4>
                            <div class="votos">
                                <div>5 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                                     style="width: @if($event->votesCalculator(5)*100 >= 5) {{ $event->votesCalculator(5)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(5)*100) }}%</div>
                            </div>
                            <div class="votos">
                                <div>4 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar"
                                     style="width: @if($event->votesCalculator(4)*100 >= 5) {{ $event->votesCalculator(4)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(4)*100) }}%</div>
                            </div>
                            <div class="votos">
                                <div>3 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar"
                                     style="width: @if($event->votesCalculator(3)*100 >= 5) {{ $event->votesCalculator(3)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(3)*100) }}%</div>
                            </div>
                            <div class="votos">
                                <div>2 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                                     style="width: @if($event->votesCalculator(2)*100 >= 5) {{ $event->votesCalculator(2)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(2)*100) }}%</div>
                            </div>
                            <div class="votos">
                                <div>1 <img class="estrella" src="../estrellas.png"/></div>
                                <div class="progress progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar"
                                     style="width: @if($event->votesCalculator(1)*100 >= 5) {{ $event->votesCalculator(1)*100 }}% @else 5% @endif">{{ intval($event->votesCalculator(1)*100) }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-md-4">
                <div class="row pagination">
                    <h1>Lugar</h1>
                    <div class="row">
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
    <script>
        $(function () {
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush