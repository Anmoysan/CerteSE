<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Una reserva esta en un evento (event)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Una reserva tiene una factura (invoice)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Una reserva se realiza en un lugar (place)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
