<div class="container">
    <div class="row">
        @foreach($invoices as $indice=>$invoice)
            <div class="col-xs-12 col-md-6 imagenevent">
                <a href="/profile/invoices/{{ $indice }}">
                    @include('invoices.invoice')
                </a>
            </div>
        @endforeach
    </div>
</div>