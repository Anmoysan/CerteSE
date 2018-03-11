<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test que prueba si puedes loguearte
     */
    public function testUserCanLogin()
    {
        $user = factory(User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test para comprobar que carga la vista principal logueado
     */
    public function testShowHomePageLogued()
    {
        $user = factory(User::class)->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);

        $response = $this->get('/');
        $responseHome = $this->get('/home');

        $response->assertStatus(302);
        $responseHome->assertStatus(302);
    }

    /**
     * Test que comprueba el perfil del usuario logueado
     */
    public function testProfile()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    }


    /**
     * Test que comprueba la configuracion del usuario logueado
     */
    public function testProfileConfiguration()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->get('/profile/configuration');
        $response->assertStatus(200);
    }

    /**
     * Test que comprueba la modificacion de datos de cuenta
     */
    public function testProfileConfigurationAccount()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/profile/configuration/account');

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba la modificacion de la contraseña
     */
    public function testProfileConfigurationPassword()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/profile/configuration/password');

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba la modificacion de avatar
     */
    public function testProfileConfigurationAvatar()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/profile/configuration/avatar');

        $response->assertStatus(200);
    }

    /**
     * Test que comprueba que podemos eliminar al usuario logeado.
     */
    public function testBorrarUsuario()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response =  $this->get('/profile/configuration/delete');

        $response->assertStatus(405);
    }

    /**
     * Test que comprueba los eventos de otro usuario
     */
    public function testEventsOtherUser()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1);
        $response = $this->get('/user/'.$user2->username);
        $response->assertStatus(200);
    }

    /**
     * Test que comprueba los comentarios del usuario logueado
     */
    public function testPorfileCommentarys()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->get('/profile/commentarys');
        $response->assertStatus(200);
    }

    /**
     * Test que comprueba los votos del usuario logueado
     */
    public function testPorfileVotes()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->get('/profile/votes');
        $response->assertStatus(200);
    }

    /**
     * Test que comprueba las facturas del usuario logueado
     */
    public function testPorfileInvoices()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->get('/profile/invoices');
        $response->assertStatus(200);
    }
}
