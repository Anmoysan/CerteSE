@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registro</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-4 control-label">Apellidos</label>

                                <input id="lastname" type="text" class="form-control" name="lastname"
                                       value="{{ old('lastname') }}">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Nick</label>

                                <input id="username" type="text" class="form-control" name="username"
                                       value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Contraseña</label>

                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmar
                                    Contraseña</label>

                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>

                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-lg-4 control-label">Movil</label>

                                <div class="input-group mb-2">
                                    <input id="mobileCountry" type="text" class="form-control col-md-4 input-group"
                                           name="mobileCountry"
                                           value="{{ old('mobileCountry') }}">
                                    @if ($errors->has('mobileCountry'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobileCountry') }}</strong>
                                    </span>
                                    @endif
                                    <input id="mobileNumber" type="text" class="form-control col-md-8"
                                           name="mobileNumber"
                                           value="{{ old('mobileNumber') }}">
                                    @if ($errors->has('mobileNumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobileNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection