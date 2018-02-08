@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Comentario de {{ $user['name'] }}</h1>
            </div>
            @foreach($commentarys as $indice=>$commentary)
                <div class="col-md-6">
                    <a href="/profile/commentarys/{{ $posicion }}">
                        @include('commentarys.commentary')
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection