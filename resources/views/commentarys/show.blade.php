@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Comentario de {{ $event['name'] }}</h1>
            </div>
            <div class="col-md-6">
                @include('commentarys.commentary')
            </div>
        </div>
    </div>
@endsection