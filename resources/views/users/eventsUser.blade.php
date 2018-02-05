@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class=" page-header titulo">Eventos creados por {{ $user->username }}</h1>
            </div>
        </div>
        @forelse($events->chunk(3) as $chunk)
            <div class="row course-set courses__row event">
                @foreach($chunk as $event)
                    @include('events.event')
                @endforeach
            </div>
        @empty
            <h1>No hay eventos programados todavia</h1>
        @endforelse
        <div class="text-center">
            {{ $events->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection