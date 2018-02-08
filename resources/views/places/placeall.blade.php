<div class="row">
    <div class="col-md-4 evento">
        <div>
            <img class="img-princ imagenevent img-responsive img-fluid img-portfolio img-hover mb-3 imagenevent"
                 src="{{ $place['image'] }}" alt="Foto del lugar."/>
        </div>
    </div>

    <div class="col-md-8 ">
        <div class="ng">
            <h3>
                {{ $place['name'] }}
            </h3>
        </div>

        <div class="ng">
            {{ $place['description'] }}
        </div>
    </div>
</div>

<div class="row">
    {{ $place['coordinate'] }}
</div>