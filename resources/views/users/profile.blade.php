@extends('layouts.app')

@section('content')
    <div class="container perfil card">
        <div class="card-group row">
            <div class="col-md-4">
                <img src="{{$user->avatar }}" id="avatar" alt="Foto del usuario">
            </div>
            <div class="col-lg-5">
                <h1>{{$user->username }}</h1>
            </div>
        </div>
        <br><br>
        <div class="card-group row">
            <div class="col-md-4">
                <p>Nombre: <strong>{{$user->name }}</strong></p>
                <p>Apellidos: <strong>{{$user->lastname }}</strong></p>
            </div>
            <div class="col-md-4">
                <p>Email: <strong>{{$user->email }}</strong></p>
                <p>Movil: <strong>{{$user->mobile }}</strong></p>
            </div>
            <div class="col-md-4">
                <p>Temas que sigues: <strong>{{$user->subject }}</strong></p>
            </div>
        </div>
        <br>
        <div class="card-group row">
            <p>Biografia: <strong>{{$user->biography }}</strong></p>
        </div>
        <br>
        <div class="card-group row">
            <p>Web: <strong><a href="{{$user->website }}">{{$user->website }}</a></strong></p>
        </div>
    </div>
@endsection