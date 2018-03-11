@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear lugar</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Lugar</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/places/{{$place['id']}}/edit" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre del lugar</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       autofocus>

                                @if($errors->has('name'))
                                    @foreach($errors->get('name') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Foto del lugar</label>
                                <input type="file" class="custom-file" name="image" id="image"
                                       placeholder="{{ old('image') }}">

                                @if($errors->has('image'))
                                    @foreach($errors->get('image') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Descripcion</label>
                                <input id="description" type="text" class="form-control" name="description"
                                       value="{{ old('description') }}">

                                @if($errors->has('description'))
                                    @foreach($errors->get('description') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }} datos input-group">
                                <div class="col-xl-6">
                                    <label for="latitud" class="col-xl-12 control-label">Latitud</label>
                                    <input id="latitud" type="text" class="form-control col-xl-12" name="latitud"
                                           value="{{ explode(", ", old('place'))[0] }}">
                                    @if($errors->has('latitud'))
                                        @foreach($errors->get('latitud') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-xl-6">
                                    <label for="longitud" class="col-xl-12 control-label">Longitud</label>
                                    <input id="longitud" type="text" class="form-control col-xl-12" name="longitud"
                                           value="{{ explode(", ", old('place'))[0] }}">
                                    @if($errors->has('longitud'))
                                        @foreach($errors->get('longitud') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info text-light
">
                                    Añadir Lugar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection