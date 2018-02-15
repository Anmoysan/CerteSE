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
                        <div class="col-md-6">
                            <div class="rating-block">
                                <h4>Media votacion</h4>
                                <h2 class="bold padding-bottom-7">{{ $votesTotal }}<small>/ 5</small></h2>
                                <!--<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Radio votacion</h4>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">1</div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">1</div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">0</div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">0</div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">0</div>
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