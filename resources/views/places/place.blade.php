<div class="col-md-4 evento">
    <div class="ng">
        <h3>
            <a href="/places/{{ $place['id'] }}">
                {{ $place['name'] }}
            </a>
        </h3>
    </div>

    <div>
        <a class="event" href="/places/{{ $place['id'] }}">
            <img class="img-princ imagenevent img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent"
                 src="{{ $place['image'] }}" alt="Foto del lugar."/>
        </a>
    </div>
</div>