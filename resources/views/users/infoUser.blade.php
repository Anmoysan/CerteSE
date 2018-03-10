<div class="card-group row">
    <div class="col-md-4 col-xs-12 d-flex justify-content-center">
        <img src="{{$user->avatar }}" id="avatar" alt="Foto del usuario">
    </div>
    <div class="col-lg-8">
        <div class="row col-lg-12 d-flex justify-content-center">
            <h1 class="col-xs-10 col-md-9 col-sm-12 col-xs-12">{{$user->username }}</h1>
            <div class="btn-group col-xl-2 col-md-3 col-sm-12 col-xs-12 d-flex justify-content-center" role="group"
                 aria-label="Basic example">
                <button type="button" class="btn btn-outline-info disabled" data-toggle="tooltip" data-placement="top"
                        title="Editar datos del usuario">Editar
                </button>
                <form action="" method="POST" id="chusqer-actions-buttons">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top"
                            title="Borrar al usuario">Eliminar
                    </button>

                </form>

            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <p>Nombre: <strong>{{$user->name }}</strong></p>
                <p>Apellidos: <strong>{{$user->lastname }}</strong></p>
            </div>
            <div class="col-md-6">
                <p>Email: <strong>{{$user->email }}</strong></p>
                <p>Movil: <strong>{{$user->mobile }}</strong></p>
            </div>
        </div>

        <div class="col-md-12">
            <p>Temas que sigues:
                <strong>
                    @forelse($user->SubjectUser() as $subject)
                        <a href="{{ url('/') }}/subjects/{{ $subject }}" class="badge badge-info text-white">{{ $subject }}</a>
                    @empty
                        <h3>No hay sigue ningun tema</h3>
                    @endforelse

                    @if(count($user->SubjectUser()) < 8)
                        <form>
                            <button id="abrirReserva" class="btn btn-outline-info" data-toggle="tooltip"
                                    data-placement="top" title="Añade o crea un tema nuevo al usuario">
                                Añadir tema
                            </button>
                        </form>
                    @endif
                </strong>
            </p>
        </div>

        <div class="col-md-12">
            <p>Web: <strong><a href="{{$user->website }}">{{$user->website }}</a></strong></p>
        </div>
    </div>
</div>
<div class="card-group row">
    <p>Biografia: <strong>{{$user->biography }}</strong></p>
</div>