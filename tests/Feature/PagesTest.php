<?php

namespace Tests\Feature;

use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    public function testShowHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Inicio');
        $response->assertSee('No hay eventos');

        $event = factory(Event::class)->create();
        $response->assertSee($event->name);
        $this->assertDatabaseHas('events', [
            'id' => $event->id
        ]);
    }

    public function testShowHomePageLogued()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Inicio');
        $response->assertSee('No hay eventos');

        $event = factory(Event::class)->create();
        $response->assertSee($event->name);
        $this->assertDatabaseHas('events', [
            'id' => $event->id
        ]);
    }
}
