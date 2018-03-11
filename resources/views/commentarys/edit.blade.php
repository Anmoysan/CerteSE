@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modificar comentario</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modificar Comentario</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/commentarys/{{ $commentary['id'] }}/edit" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

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
                                <button type="submit" class="btn btn-info text-light">
                                    Modificar Comentario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection