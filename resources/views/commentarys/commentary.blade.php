<div class="col-md-12 izq row card-group">
    <div class="col-md-2 col-xl-1">
        <a href="/user/{{ $commentary->DateUserWithComment()->username }}"><img class="imagecomment" src="{{ $commentary->DateUserWithComment()->avatar }}"></a>
    </div>
    <div class="col-md-10 col-xl-11">
        <div>
            <a href="/user/{{ $commentary->DateUserWithComment()->username }}">{{ $commentary->DateUserWithComment()->username }}</a>
        </div>
        <div>
            <strong>
                {{ $commentary['content'] }}
            </strong>
        </div>
    </div>
</div>