<div class="col-md-12 izq row">
    {{ App\User::where('id', $commentary['user_id'])->first()->username }}
    <h3>
        {{ $commentary['content'] }}
    </h3>
</div>