@auth()
    <form action="{{ $event['id'] }}/commentarys/create" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input id="event_id" type="hidden" name="event_id" value="{{ $event['id'] }}">
            <div class="md-input">
                <input id="content" name="content" class="md-form-control" required="" type="text">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Escribe un comentario</label>
            </div>
            @if( $errors->has('content') )
                <p class="validation-error">{{ $errors->first('content') }}</p>
            @endif
        </div>
    </form>
    <hr>
@endauth