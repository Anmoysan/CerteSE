@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Comentario</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/commentarys/create" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label">Comenta</label>
                                <input id="content" type="text" class="form-control" name="content"
                                       value="{{ old('content') }}">
                                @if($errors->has('content'))
                                    @foreach($errors->get('content') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Añadir Comentario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection