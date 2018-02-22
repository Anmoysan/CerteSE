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
     *
     * @return $this
     */

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('date', 'asc');
    }

    /**
     * Un usuario puede tener varios comentarios (commentarys)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function commentaries()
    {
        return $this->hasMany(Commentary::class)->latest();
    }

    /**
     * Un usuario puede tener varios votos (votes)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function votes()
    {
        return $this->hasMany(Vote::class)->latest();
    }

    /**
     * Un usuario puede tener varias facturas (invoices)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
    }

    /**
     * Un usuario puede realizar varias reservas (reserve)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function reserves()
    {
        return $this->hasMany(Reserve::class)->latest();
    }


    public function VoteEvent(Event $event)
    {
        return $this->votes->contains('event_id', $event->id);
    }

    public function isMyEvent(Event $event)
    {
        return $this->id == $event->user_id;
    }

    public function ReserveEvent(Event $event)
    {
        return $this->reserves->contains('event_id', $event->id);
    }
}
