<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Un evento puede tener varios usuarios (users)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un evento puede tener varios comentarios (commentarys)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function commentaries()
    {
        return $this->hasMany(Commentary::class)->latest();
    }

    /**
     * Un evento puede tener varios votos (votes)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function votes()
    {
        return $this->hasMany(Vote::class)->latest();
    }

    /**
     * Un evento puede tener muchas reservas (reserves)
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function reserves()
    {
        return $this->hasMany(Reserve::class)->latest();
    }

    /**
     * Un evento se realiza en un lugar (place)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Permite obtener la media de un evento
     *
     * @return int
     */
    public function votesMean()
    {
        $votes = $this->votes;

        $votesTotal = 0;

        foreach ($votes as $vote) {
            $votesTotal += $vote->vote;
        }

        if ($votes->count() > 0) {
            $votesTotal /= $votes->count();
        } else {
            $votesTotal = 0;
        }

        return $votesTotal;
    }

    public function votesCalculator($num)
    {
        $votes = $this->votes;

        $votesTotal = 0;

        foreach ($votes as $vote) {
            if ($vote->vote == $num) {
                $votesTotal += 1;
            }
        }

        if ($votes->count() > 0) {
            $votesTotal /= $votes->count();
        } else {
            $votesTotal = 0;
        }

        return $votesTotal;
    }
}
