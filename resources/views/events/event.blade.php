<div class="col-md-4 evento">
    <div class="ng">
        <h3>
            <a href="/events/{{ $event['id'] }}">
                {{ $event['name'] }}
            </a>
        </h3>
    </div>

    <div>
        <a class="event" href="/events/{{ $event['id'] }}">
        <img class="img-princ imagenevent img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent"
             src="{{ $event['image'] }}" alt="Foto del evento."/>
        </a>
    </div>

    <div>
        <p>
            <a href="/user/{{ $event->user->username }}">
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
        <p class="date ng">
            Fecha: {{ $event['date'] }}
        </p>
    </div>
</div>