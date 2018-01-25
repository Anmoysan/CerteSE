@extends('layouts.app')

@section('content')
    <div>
        <p>Nombre: <strong>{{ $event['name'] }}</strong></p>
        <p>Imagen: <strong>{{ $event['image'] }}</strong></p>
        <p>Lugar: <strong>{{ $event['place'] }}</strong></p>
    </div>
@endsection