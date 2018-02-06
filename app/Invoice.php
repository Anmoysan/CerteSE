<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Una factura es recibida por un usuario (user)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una factura es creada por una reserva (reserve)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }
}
