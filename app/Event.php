<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
     * Un evento tiene varios temas (subject)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * Permite obtener la media de votos de un evento
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

    /**
     * Permite obtener el procentaje de votos de un evento
     *
     * @param $num
     * @return int
     */
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

    /**
     * Devuelve los tag de los temas que tiene un evento
     *
     * @return mixed
     */
    public function SubjectEvent()
    {
        return $this->subjects->pluck('tag');
    }
}
