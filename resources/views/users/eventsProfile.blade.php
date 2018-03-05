<div class="container">
    <div id="listado">
        @include('events.listaevents')
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/paginationMyEvents.js') }}" defer></script>
@endpush