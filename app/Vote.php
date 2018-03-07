<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Un voto es creado por un usuario (user)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un voto es añadido en un evento (event)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function DateUserWithVote()
    {
        return User::where('id', $this['user_id'])->first();
    }
}
