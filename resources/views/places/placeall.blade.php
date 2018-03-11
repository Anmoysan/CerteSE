<div class="row card">
    <div class="card-group">
        <div class="col-md-8 card-body">
            <div>
                <h3 class="col-xs-10 col-md-9 col-sm-12 col-xs-12">
                    {{ $place['name'] }}
                </h3>
                @if(Auth::user()->isMyPlace())
                    <div class="btn-group col-xl-2 col-md-3 col-sm-12 col-xs-12 d-flex justify-content-center"
                         role="group"
                         aria-label="Basic example">
                        <button type="button" class="btn btn-outline-info disabled" data-toggle="tooltip"
                                data-placement="top"
                                title="Editar datos del usuario">Editar
                        </button>
                        <form action="{{route('place.delete',array('id' => $place['id']))}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-outline-info" data-toggle="tooltip"
                                    data-placement="top"
                                    title="Borrar al usuario">Eliminar
                            </button>
                        </form>
                    </div>
                @endif
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
    <script>
        $(function () {
            maps('{{ explode(", ", $place['coordinate'])[0] }}', '{{ explode(", ", $place['coordinate'])[1] }}', '{{ $place['name'] }}');
        })
    </script>
@endpush