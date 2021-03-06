<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 20)->create();
        $subjects = factory(App\Subject::class, 20)->create();

        $users->each(function (App\User $user) use ($users, $subjects) {
            factory(App\Place::class, 4)->create([
                'user_id' => $user->id
            ]);
            $place = App\Place::inRandomOrder()->first();

            $user->subjects()->sync(
                $subjects->random(mt_rand(2, 8))
            );
            $events = factory(App\Event::class, 20)->create([
                'user_id' => $user->id,
                'place_id' => $place->id
            ]);

            $events->each(function (App\Event $event) use ($user, $events, $subjects) {
                $event->subjects()->sync(
                    $subjects->random(mt_rand(2, 8))
                );
                $reserves = factory(App\Reserve::class, 20)->create([
                    'user_id' => $user->id,
                    'event_id' => $event->id
                ]);

                factory(\App\Vote::class, 10)->create([
                    'user_id' => $user->id,
                    'event_id' => $event->id
                ]);

                if ($event->commentarys == true || $event->commentarys == 1) {
                    factory(\App\Commentary::class, 10)->create([
                        'user_id' => $user->id,
                        'event_id' => $event->id
                    ]);
                }

                $reserves->each(function (App\Reserve $reserve) use ($reserves) {
                    factory(\App\Invoice::class, 1)->create([
                        'user_id' => $reserve->user_id,
                        'reserve_id' => $reserve->id
                    ]);
                });
            });
        });
    }
}
