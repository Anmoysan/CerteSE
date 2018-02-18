<div class="col-md-12 izq row card-group">
    <div class="col-md-1">
        <a href="/user/{{ App\User::where('id', $commentary['user_id'])->first()->username }}"><img class="imagecomment" src="{{ App\User::where('id', $commentary['user_id'])->first()->avatar }}"></a>
    </div>
    <div class="col-md-11">
        <div>
            <a href="/user/{{ App\User::where('id', $commentary['user_id'])->first()->username }}">{{ App\User::where('id', $commentary['user_id'])->first()->username }}</a>
        </div>
        <div>
            <strong>
                {{ $commentary['content'] }}
            </strong>
        </div>
    </div>
</div>