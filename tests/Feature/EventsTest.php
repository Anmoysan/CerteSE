<?php

namespace Tests\Feature;

use App\Commentary;
use App\Event;
use App\Place;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventsTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Test que comprueba que carga la lista de eventos
     */
    public function testEvents()
    {
        $response = $this->get('/events/');

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba que un evento en específico carga bien
     */
    public function testShowEvent()
    {
        $user = factory(User::class)->create();
        $place = factory(Place::class)->create([
            'user_id' => $user->id
        ]);
        $event = factory(Event::class)->create([
            'user_id' => $user->id,
            'place_id' => $place->id
        ]);
        $votesTotal = 0;

        $response = $this->get('/events/'.$event->id);

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba si se puede crear un evento
     */
    public function testCreateEventError()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/events/create', [
            'name' => 'dsa',
            'place' => 'd'
        ]);

        $response->assertSessionHas('errors');
    }

    public function testEditEvent()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $place = factory(Place::class)->create([
            'user_id' => $user->id
        ]);
        $event = factory(Event::class)->create([
            'user_id' => $user->id,
            'place_id' => $place->id
        ]);
        $votesTotal = 0;

        $response = $this->get('/events/'.$event->id);

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba si se borra un evento
     */
    public function testDeleteEvent()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $event = factory(Event::class)->create([
            'user_id' => $user->id
        ]);
        $this->actingAs($user);

        $response = $this->get('/events/'.$event->id.'/delete');

        $response->assertStatus(200);
    }
}
