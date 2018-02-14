<div class="card col-md-3 evento">
    <div class="card-block">
        <h4 class="card-title"><a href="/places/{{ $place['id'] }}">{{ $place['name'] }}</a></h4>
    </div><hr>

    <div class="card-block">
        <a class="event" href="/places/{{ $place['id'] }}"><img class="img-princ imagenevent img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent" src="{{ $place['image'] }}" alt="Foto de {{ $place['name'] }}."/></a>
    </div>

    @isset($user)
        @if($user->id == $event->user_id)
            <div class="card-block">
                <a href="#" class="card-link">Editar</a>
                <a href="#" class="card-link">Eliminar</a>
            </div>
        @endif
    @endisset
</div>