<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Un comentario es creado por un usuario (user)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un comentario es añadido en un evento (event)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
