<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $user['username'] }}</h1>
        </div>
        @foreach($invoices as $indice=>$invoice)
            <div class="col-md-6">
                <a href="/profile/invoices/{{ $indice }}">
                    @include('invoices.invoice')
                </a>
            </div>
        @endforeach
    </div>
</div>