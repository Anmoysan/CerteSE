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
}
