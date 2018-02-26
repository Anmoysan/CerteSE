@extends('layouts.app')

@section('content')
    <div class="container card">
        <div class="row card-group">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
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
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <hr>
        <div class="col-xl-12">
            <div></div>
            <div class="scrollHorizontal">
                <div class="row text-center">
                    @forelse($events as $event)
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
                    @empty
                        <h1>No hay eventos programados todavia</h1>
                    @endforelse
                </div>
            </div>
        </div>
        <hr>
        <div class="container">

        </div>


    </div>
@endsection