<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

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
}
