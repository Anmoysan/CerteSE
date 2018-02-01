<?php

use Faker\Generator as Faker;
use \Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Event::class, function (Faker $faker) {

    $time1 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $time2 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $timeyear = Carbon::createFromTimestamp($faker->dateTimeThisYear()->getTimestamp());
    $place = $faker->randomFloat(6, -85, 85)."|".$faker->randomFloat(6, -180, 180);

    return [
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true) ,
        'image'      => 'https://picsum.photos/150/150/?random',
        'place'      => $place,
        'subject'     => $faker->word,
        'date' => $timeyear,
        'duration' => $faker->time('H:i'),
        'cost'    => $faker->randomFloat(2,0,50),
        'agemin' => $faker->numberBetween(0, 18),
        'organizer' => $faker->userName,
        'created_at' => ($time1 < $time2) ? $time1 : $time2,
        'updated_at' => ($time1 > $time2) ? $time1 : $time2
    ];
});
