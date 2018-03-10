<?php

use Faker\Generator as Faker;
use \Carbon\Carbon;

$factory->define(App\Subject::class, function (Faker $faker) {

    $tag =  str_random(10);
    $time1 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $time2 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());

    return [
        'tag' => $tag,
        'created_at'=> ($time1 < $time2) ? $time1 : $time2,
        'updated_at'=> ($time1 > $time2) ? $time1 : $time2
    ];
});
