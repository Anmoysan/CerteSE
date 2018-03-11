<div class="col-md-12 izq row card-group">
    <div class="col-md-2 col-xl-1">
        <a href="/user/{{$commentary->DateUserWithComment()->username }}"><img class="imagecomment"
                                                                                src="{{ $commentary->DateUserWithComment()->avatar }}"></a>
    </div>
    <div class="col-md-10 col-xl-11">
        <div>
            <a class="col-xs-10 col-md-9 col-sm-12 col-xs-12"
               href="/user/{{ $commentary->DateUserWithComment()->username }}">{{ $commentary->DateUserWithComment()->username }}</a>
            @if(Auth::check() && $user->isMyCommentary($commentary))
                <div class="btn-group col-xl-2 col-md-3 col-sm-12 col-xs-12 d-flex justify-content-center"
                     role="group"
                     aria-label="Basic example">
                    <a class="btn btn-outline-info" href="{{ url('/') }}/commentarys/{{ $commentary['id'] }}/edit" data-toggle="tooltip" data-placement="top"
                       title="Editar datos del usuario">Editar</a>
                    <form action="{{route('commentary.delete',array('id' => $commentary['id']))}}" method="POST">
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
            <strong>
                {{ $commentary['content'] }}
            </strong>
        </div>
    </div>
</div>