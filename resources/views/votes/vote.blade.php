<div class="col-md-12 izq row">
    {{ App\User::where('id', $vote['user_id'])->first()->username }} voto <strong>{{ $vote['vote'] }}/5</strong>
</div>