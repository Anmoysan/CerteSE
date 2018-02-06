<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Un lugar puede tener varias reservas (reserves)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function reserves()
    {
        return $this->hasMany(Reserve::class)->latest();
    }
}
