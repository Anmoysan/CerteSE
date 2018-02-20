<div id="load" style="position: relative;" class="card col-md-5 evento">
    <div class="card-block">
        <h4 class="card-title"><a href="/events/{{ $event['id'] }}">{{ $event['name'] }}</a></h4>
    </div>
    <hr>

    <div class="card-block">
        <a href="/events/{{ $event['id'] }}"><img class="card-img-top img-princ imagenevent img-responsive"
                                                  src="{{ $event['image'] }}" alt="Foto de {{ $event['name'] }}"></a>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">Votacion: <strong>{{ number_format($event->votesMean(), 2, '.', '') }} / 5</strong></li>
        <li class="list-group-item">Precio: <strong>{{ $event['cost'] }}</strong></li>
        <li class="list-group-item">Fecha: <strong>{{ $event['date'] }}</strong></li>
    </ul>

    @if( Auth::check())
        @if(Auth::user()->isMyEvent($event))
            <div class="card-block">
                <a href="#" class="card-link">Editar</a>
                <a href="#" class="card-link">Eliminar</a>
            </div>
        @endif
    @endif
</div>