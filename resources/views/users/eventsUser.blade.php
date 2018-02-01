@extends('layouts.app')

@section('content')
    <h1 class="titulo">Eventos creados por {{ $user->username }}</h1>
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
@endsection