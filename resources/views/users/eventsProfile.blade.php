<div class="container">
    <div id="listado">
        @forelse($events->chunk(2) as $chunk)
            <div class="row course-set courses__row event d-flex justify-content-around">
                @foreach($chunk as $event)
                    @include('events.event')
                @endforeach
            </div>
        @empty
            <h1>No hay eventos programados todavia</h1>
        @endforelse

        <div class="pagination">
            {{ $events->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{ asset('js/paginationMyEvents.js') }}" defer></script>
@endpush