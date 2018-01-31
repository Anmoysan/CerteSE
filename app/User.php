<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'username', 'biography', 'subject', 'website', 'mobile', 'avatar', 'password', 'ban', 'timeban'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ban', 'timeban'
    ];

    /**
     * Un usuario estara en varios eventos (events)
     */
    public function events()
    {
        return $this->hasMany(Event::class)->latest();
    }
}
