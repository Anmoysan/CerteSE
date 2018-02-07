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

$factory->define(App\Invoice::class, function (Faker $faker) {

    $time1 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $time2 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $timeyear = Carbon::createFromTimestamp($faker->dateTimeInInterval('-10 years', '+20 years')->getTimestamp());
    $place = $faker->streetAddress;

    return [
        'buyer' => $faker->userName,
        'place' => $place,
        'date' => $timeyear,
        'cost'    => $faker->randomFloat(2,0,50),
        'units' => $faker->numberBetween(0, 100),
        'created_at' => ($time1 < $time2) ? $time1 : $time2,
        'updated_at' => ($time1 > $time2) ? $time1 : $time2
    ];
});
