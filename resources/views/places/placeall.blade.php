<div class="row card">
    <div class="card-group">
        <div class="col-md-8 card-body">
            <div>
                <h3>
                    {{ $place['name'] }}
                </h3>
            </div>

            <div>
                {{ $place['description'] }}
            </div>
        </div>

        <div class="col-md-4 card-body">
            <img class="imagenevent"
                 src="{{ $place['image'] }}" alt="Foto del lugar."/>
        </div>
    </div>

    <div class="col-md-12">
        <div id="map" class="mapfull"></div>
    </div>
</div>



@push('scripts')
    <script src="{{ asset('js/show.js') }}" defer></script>
    <script >
        $(function(){
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush