@extends('layouts.app')

@section('content')
    <div class="container perfil card">
        <div class="card-group row">
            <div class="col-md-4 col-xs-12">
                <img src="{{$user->avatar }}" id="avatar" alt="Foto del usuario">
            </div>
            <div class="col-lg-8">
                <h1>{{$user->username }}</h1>

                <div class="row">
                    <div class="col-md-6">
                        <p>Nombre: <strong>{{$user->name }}</strong></p>
                        <p>Apellidos: <strong>{{$user->lastname }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <p>Email: <strong>{{$user->email }}</strong></p>
                        <p>Movil: <strong>{{$user->mobile }}</strong></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <p>Temas que sigues: <strong>{{$user->subject }}</strong></p>
                </div>

                <div class="col-md-12">
                    <p>Web: <strong><a href="{{$user->website }}">{{$user->website }}</a></strong></p>
                </div>
            </div>
        </div>
        <div class="card-group row">
            <p>Biografia: <strong>{{$user->biography }}</strong></p>
        </div>
    </div>
@endsection