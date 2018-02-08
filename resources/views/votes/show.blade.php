@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Votos de {{ $event['name'] }}</h1>
            </div>
            @foreach($votes as $vote)
                <div class="col-md-6">
                    @include('votes.vote')
                </div>
            @endforeach
        </div>
    </div>
@endsection