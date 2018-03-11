<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
     * Un usuario puede indicar varios lugares (places)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function places()
    {
        return $this->hasMany(Place::class)->latest();
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

    /**
     * Un usuario tiene interes en varios temas (subject)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * Confirma si un usuario voto a un evento o no
     *
     * @param Event $event
     * @return mixed
     */
    public function VoteEvent(Event $event)
    {
        return $this->votes->contains('event_id', $event->id);
    }

    /**
     * Devuelve si un evento es del usuario logueado o no
     *
     * @param Event $event
     * @return bool
     */
    public function isMyEvent(Event $event)
    {
        return $this->id == $event->user_id;
    }

    /**
     * Devuelve si un comentario es del usuario logueado o no
     *
     * @param Event $event
     * @return bool
     */
    public function isMyCommentary(Commentary $commentary)
    {
        return $this->id == $commentary->user_id;
    }

    /**
     * Devuelve si un comentario es del usuario logueado o no
     *
     * @return bool
     */
    public function isMyPlace(Place $place)
    {
        return $this->id == $place->user_id;
    }

    /**
     * Dice si el usuario logueado hizo una reserva en un evento o no
     *
     * @param Event $event
     * @return mixed
     */
    public function ReserveEvent(Event $event)
    {
        return $this->reserves->contains('event_id', $event->id);
    }

    /**
     * Devuelve los tags de los temas que le interesa al usuario
     *
     * @return mixed
     */
    public function SubjectUser()
    {
        return $this->subjects->pluck('tag');
    }

    /**
     * Devuelve la reserva de un usuario a un evento
     *
     * @param $event
     * @param $valor
     * @return mixed
     */
    public function ReserveInvoiceUser($event, $valor)
    {
        return Reserve::where('user_id', $this->id)->where('event_id', $event->id)->first()->$valor;
    }
}
