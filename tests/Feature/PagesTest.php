<?php

namespace Tests\Feature;

use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
    /**
     * Test para comprobar que carga la vista principal sin loguearse
     */
    public function testShowHomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
