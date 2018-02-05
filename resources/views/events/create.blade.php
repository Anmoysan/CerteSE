@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir evento</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/events/create" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre de evento</label>
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
                                <label for="image" class="col-md-4 control-label">Foto del evento</label>
                                <input id="image" type="text" class="form-control" name="image"
                                       value="{{ old('image') }}" autofocus>

                                @if($errors->has('image'))
                                    @foreach($errors->get('image') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <div class="input-group mb-2">
                                    <label for="latitud" class="col-lg-6 control-label">Latitud</label>
                                    <label for="longitud" class="col-lg-6 control-label">Longitud</label>
                                </div>
                                <div class="input-group mb-2">
                                    <input id="latitud" type="text" class="form-control" name="latitud"
                                           value="{{ explode(",", old('place'))[0] }}" autofocus>
                                    @if($errors->has('latitud'))
                                        @foreach($errors->get('latitud') as $message)
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endforeach
                                    @endif

                                    <input id="longitud" type="text" class="form-control" name="longitud"
                                           value="{{ explode(",", old('place'))[0] }}" autofocus>
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
                                <input id="subject" type="text" class="form-control" name="subject"
                                       value="{{ old('subject') }}" autofocus>

                                @if($errors->has('subject'))
                                    @foreach($errors->get('subject') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-md-4 control-label">Fecha evento</label>
                                <input id="date" type="date" class="form-control" name="date"
                                       value="{{ old('date') }}" autofocus>

                                @if($errors->has('date'))
                                    @foreach($errors->get('date') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                                <label for="duration" class="col-md-4 control-label">Duracion evento</label>
                                <input id="duration" type="time" class="form-control" name="duration"
                                       value="{{ old('duration') }}" autofocus>

                                @if($errors->has('duration'))
                                    @foreach($errors->get('duration') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                <label for="cost" class="col-md-4 control-label">Precio entrada</label>
                                <input id="cost" type="number" class="form-control" name="cost"
                                       value="{{ old('cost') }}" autofocus>

                                @if($errors->has('cost'))
                                    @foreach($errors->get('cost') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('agemin') ? ' has-error' : '' }}">
                                <label for="agemin" class="col-md-4 control-label">Edad minima</label>
                                <input id="agemin" type="number" min="0" max="100" class="form-control"
                                       name="agemin" value="{{ old('agemin') }}" autofocus>

                                @if($errors->has('agemin'))
                                    @foreach($errors->get('agemin') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('organizer') ? ' has-error' : '' }}">
                                <label for="organizer" class="col-md-4 control-label">Organizador</label>
                                <input id="organizer" type="text" class="form-control" name="organizer"
                                       value="{{ old('organizer') }}" autofocus>

                                @if($errors->has('organizer'))
                                    @foreach($errors->get('organizer') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Añadir evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection