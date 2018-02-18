<div class="col-md-4 fondoNav text-info">
    <div class="ng">
        <h3>
            Factura nº: {{ $invoice['id'] }}
        </h3>
    </div>

    <div>
        <p>
            Comprador: {{ $invoice['buyer'] }}
        </p>
        <p>
            Lugar: {{ $invoice['place'] }}
        </p>
        <p>
            Fecha: {{ $invoice['date'] }}
        </p>
        <p class="ng">
            Precio: {{ $invoice['cost'] }} €
            Unidades: {{ $invoice['units'] }}
        </p>
    </div>
</div>