@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Añadir evento</div>

                    <div class="panel-body">
                        <form action="{{ url('/') }}/events/create" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre de evento</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                    @if($errors->has('name'))
                                        @foreach($errors->get('name') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Foto del evento</label>
                                <div class="col-md-6">
                                    <input id="image" type="text" class="form-control" name="image" value="{{ old('image') }}" autofocus>

                                    @if($errors->has('image'))
                                        @foreach($errors->get('image') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <label for="latitud" class="col-md-2 control-label">Latitud</label>
                                <div class="col-md-3">
                                    <input id="latitud" type="text" class="form-control" name="latitud" value="{{ explode(",", old('place'))[0] }}" autofocus>

                                    @if($errors->has('latitud'))
                                        @foreach($errors->get('latitud') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"></div>

                                <label for="longitud" class="col-md-2 control-label">Longitud</label>
                                <div class="col-md-3">
                                    <input id="longitud" type="text" class="form-control" name="longitud" value="{{ explode(",", old('place'))[0] }}" autofocus>

                                    @if($errors->has('longitud'))
                                        @foreach($errors->get('longitud') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label for="subject" class="col-md-4 control-label">Tema</label>
                                <div class="col-md-6">
                                    <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" autofocus>

                                    @if($errors->has('subject'))
                                        @foreach($errors->get('subject') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-md-4 control-label">Fecha evento</label>
                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}" autofocus>

                                    @if($errors->has('date'))
                                        @foreach($errors->get('date') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                                <label for="duration" class="col-md-4 control-label">Duracion evento</label>
                                <div class="col-md-6">
                                    <input id="duration" type="time" class="form-control" name="duration" value="{{ old('duration') }}" autofocus>

                                    @if($errors->has('duration'))
                                        @foreach($errors->get('duration') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                <label for="cost" class="col-md-4 control-label">Precio entrada</label>
                                <div class="col-md-6">
                                    <input id="cost" type="number" min="0" max="20" class="form-control" name="cost" value="{{ old('cost') }}" autofocus>

                                    @if($errors->has('cost'))
                                        @foreach($errors->get('cost') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('agemin') ? ' has-error' : '' }}">
                                <label for="agemin" class="col-md-4 control-label">Edad minima</label>
                                <div class="col-md-6">
                                    <input id="agemin" type="number" min="0" max="100" class="form-control" name="agemin" value="{{ old('agemin') }}" autofocus>

                                    @if($errors->has('agemin'))
                                        @foreach($errors->get('agemin') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('organizer') ? ' has-error' : '' }}">
                                <label for="organizer" class="col-md-4 control-label">Organizador</label>
                                <div class="col-md-6">
                                    <input id="organizer" type="text" class="form-control" name="organizer" value="{{ old('organizer') }}" autofocus>

                                    @if($errors->has('organizer'))
                                        @foreach($errors->get('organizer') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Añadir evento
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection