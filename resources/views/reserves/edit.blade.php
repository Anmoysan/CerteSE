@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir Reserva</div>

                    <div class="card-body">
                        <form action="{{ url('/') }}/reserves/{{ $reserve['id'] }}/edit" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

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
                                <input id="date" type="date" class="form-control" name="date"
                                       value="{{ old('date') }}">
                                @if($errors->has('date'))
                                    @foreach($errors->get('date') as $message)
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

                            <div class="form-group{{ $errors->has('units') ? ' has-error' : '' }}">
                                <label for="units" class="col-md-4 control-label">Unidades</label>
                                <input id="units" type="number" class="form-control" name="units" value="{{ old('units') }}">
                                @if($errors->has('units'))
                                    @foreach($errors->get('units') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info text-light">
                                    Añadir Reserva
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection