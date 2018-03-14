@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
@endsection

@section('content')
    <div class="container card">
        <div class="row card-group">
            <div id="carousel" class="carousel slide w-100 m-auto" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="{{ asset('carousel1.jpg') }}" alt="Primera imagen">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{ asset('carousel2.jpg') }}" alt="Segunda imagen">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{ asset('carousel3.jpg') }}" alt="Tercera imagen">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <hr>
        <div class="col-xl-12">
            <div></div>
            <div id="scrollHorizontal" class="scrollHorizontal">
                <div class="row text-center">
                    @if(count($events) > 0)
                        @foreach($events as $event)
                            <div class="col-xl-4 col-md-6 col-sm-12 eventoScroll">
                                <div class="card-block">
                                    <h4 class="card-title"><a href="/events/{{ $event['id'] }}">{{ $event['name'] }}</a>
                                    </h4>
                                </div>
                                <hr>

                                <div class="card-block">
                                    <a href="/events/{{ $event['id'] }}"><img
                                                class="card-img-top img-princ imagenevent img-responsive"
                                                src="{{ $event['image'] }}" alt="Foto de {{ $event['name'] }}"></a>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Votacion:
                                        <strong>{{ number_format($event->votesMean(), 2, '.', '') }} / 5</strong></li>
                                    <li class="list-group-item">Precio: <strong>{{ $event['cost'] }}</strong></li>
                                    <li class="list-group-item">Fecha: <strong>{{ $event['date'] }}</strong></li>
                                </ul>
                            </div>
                        @endforeach

                        <div class="col-xl-4 col-md-6 col-sm-12 eventoScroll">
                            <div class="card-block">
                                <a href="{{ url('/') }}/events/">
                                    <img class="card-img-top img-princ imagenevent img-responsive"
                                         src="{{ asset('registro.jpg') }}">
                                    <h3>Ver más eventos</h3>
                                </a>
                            </div>
                        </div>


                    @else
                        <h1>No hay eventos programados todavia</h1>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="container">

        </div>


    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}" defer></script>
@endpush