<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Un lugar puede tener varias eventos (events)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function events()
    {
        return $this->hasMany(Event::class)->latest();
    }

    /**
     * Un lugar puede ser indicado por un usuario (user)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
