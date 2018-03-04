<div class="media factura card">
    <div class="text-white container">
        <h3 class="align-content-center card-title align-items-center">
            Factura nº: {{ $invoice['id'] }}
        </h3>
        <hr>
        <div>
            <p class="imagenevent">
                Lugar: {{ $invoice['place'] }}
            </p>
            <p class="imagenevent">
                Fecha: {{ $invoice['date'] }}
            </p>
            <div class="card-columns imagenevent">
                <p>
                    Precio: {{ $invoice['cost'] }} €
                </p>
                <p>
                    Unidades: {{ $invoice['units'] }}
                </p>
            </div>
        </div>
    </div>
</div>