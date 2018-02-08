@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Votos de {{ $user['name'] }}</h1>
            </div>
            @foreach($votes as $vote)
                <div class="col-md-6">
                    <a href="/profile/votes/">
                        @include('votes.vote')
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection