@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar evento</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modificar evento</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/events/{{ $event['id'] }}/edit" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre de evento</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if($errors->has('name'))
                                    @foreach($errors->get('name') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Imagen</label>
                                <input id="image" type="text" class="form-control" name="image" value="{{ old('image') }}" autofocus>

                                @if($errors->has('image'))
                                    @foreach($errors->get('image') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <label for="place" class="col-md-4 control-label">Lugar</label>
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="place" id="place">
                                    @foreach($places as $place)
                                        <option value={{ $place['id'] }}>{{ $place['name'] }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('place'))
                                    @foreach($errors->get('place') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-md-4 control-label">Fecha evento</label>
                                <input id="date" type="text" class="form-control" name="date"
                                       value="{{ old('date') }}">

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
                                       value="{{ old('duration') }}">

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
                                       value="{{ old('cost') }}">

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
                                       name="agemin" value="{{ old('agemin') }}">

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
                                       value="{{ old('organizer') }}">

                                @if($errors->has('organizer'))
                                    @foreach($errors->get('organizer') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('commentarys') ? ' has-error' : '' }}">
                                <label class="mr-sm-2" for="commentarys">¿Quieres comentarios?</label>
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="commentarys" id="commentarys">
                                    <option value=1 selected>Si</option>
                                    <option value=0>No</option>
                                </select>

                                @if($errors->has('commentarys'))
                                    @foreach($errors->get('commentarys') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info text-light">
                                    Modificar evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/datetime.js') }}"></script>
@endpush