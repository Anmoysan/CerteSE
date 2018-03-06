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

$factory->define(App\User::class, function (Faker $faker) {

    $name = $faker->name;
    $lastname = $faker->lastName;
    $username = str_replace(" ", ".", $name . "." . $lastname);
    $usernamefinal = str_replace("..", ".", $username);
    $ban = $faker->boolean;
    $timeban = $ban ? $faker->numberBetween(1, 30) : 0;
    $time1 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());
    $time2 = Carbon::createFromTimestamp($faker->dateTimeThisDecade()->getTimestamp());

    return [
        'name' => $name,
        'lastname' => $lastname,
        'username' => $usernamefinal,
        'email' => $faker->email,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'avatar' => 'https://picsum.photos/150/150/?random',
        'biography'     => $faker->realText(255),
        'website'     => $faker->url,
        'mobile'     => $faker->e164PhoneNumber,
        'ban'     => $ban,
        'timeban' => $timeban,
        'remember_token' => str_random(10),
        'created_at' => ($time1 < $time2) ? $time1 : $time2,
        'updated_at' => ($time1 > $time2) ? $time1 : $time2
    ];
});
