@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{$user->avatar }}" id="avatar" alt="Foto del usuario">
        </div>
        <div class="col-lg-5">
            <h1>{{$user->username }}</h1>
        </div>
        <div class="col-lg-3">
            <h3>El usuario esta baneado: {{$user->ban==1 || $user->ban ? "Si" : "No" }}</h3>
            @if($user->ban || $user->ban==1)
                <h3>Tiempo baneado: {{$user->timeban}}</h3>
            @endif
        </div>
    </div><br><br>
    <div class="row">
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
    </div><br>
    <div class="row">
        <p>Biografia: <strong>{{$user->biography }}</strong></p>
    </div><br>
    <div class="row">
        <p>Web: <strong>{{$user->website }}</strong></p>
    </div>
@endsection