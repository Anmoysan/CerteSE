<div class="col-md-4">
    <div class="ng">
        <h3>
            {{ $event['name'] }}
        </h3>
    </div>

    <div>
        <img class="img-princ img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent"
             src="{{ $event['image'] }}" alt="Foto del evento."/>
    </div>

    <div>
        <p>
            <a href="/user/{{ $event->user->id }}">
                {{ $event->user->username }}
            </a>
        </p>
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