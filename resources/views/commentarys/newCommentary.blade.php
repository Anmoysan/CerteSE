@auth()
    <form action="{{ $event['id'] }}/commentarys/create" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input id="event_id" type="hidden" name="event_id" class="hidden" value="{{ $event['id'] }}">
            <input id="content" type="text" name="content" value="{{ old('content') }}" aria-describedby="contentHelpText" class="{{ $errors->has('content') ? 'is-invalid-input' : ''}}">
            @if( $errors->has('content') )
                <p class="validation-error">{{ $errors->first('content') }}</p>
            @endif
            <p class="help-text" id="contentHelpText">Introduce un nuevo comentario</p>
        </div>
    </form>
    <hr>
@endauth