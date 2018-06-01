<div class="col-md-12 izq row card-group">
    @if($commentary->DateUserWithComment() != null)
    <div class="col-md-2 col-xl-1">
        <a href="/user/{{ $commentary->DateUserWithComment()->username }}"><img class="imagecomment"
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
                    <a class="btn btn-outline-info icono-keyboard" href="{{ url('/') }}/commentarys/{{ $commentary['id'] }}/edit" data-toggle="tooltip" data-placement="top"
                       title="Editar comentario">Editar</a>
                    <form action="{{route('commentary.delete',array('id' => $commentary['id']))}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input id="commentid" type="hidden" value="{{$commentary['id']}}">

                        <button type="submit" id="eliminarComment" class="btn btn-outline-info icono-trash" data-toggle="tooltip"
                                data-placement="top"
                                title="Borrar comentario">Eliminar
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
        @endif
</div>