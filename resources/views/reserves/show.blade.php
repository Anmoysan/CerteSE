@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $event['name'] }}</h1>
            </div>
            @foreach($reserves as $indice=>$reserve)
                <div class="col-md-6">
                    <a href="/events/{{ $event['id'] }}/reserves/{{ $indice }}">
                        @include('reserves.reserve')
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection