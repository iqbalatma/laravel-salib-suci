<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginView()
    {
        $response = $this->get('/login');

        $response->assertSeeText("Sign In")->assertSeeText('Enter your email and password to sign in')->assertStatus(200);
    }

    public function testAuthenticateSuccess()
    {
        $response = $this->post('/authenticate', ['email' => 'iqbalatma@gmail.com', 'password' => 'admin']);

        $response
            ->assertSessionHasNoErrors()
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    public function testAuthenticateFailed()
    {
        $response = $this->post('/authenticate', ['email' => 'wrong@gmail.com', 'password' => 'wrong']);

        $response
            ->assertStatus(302);
    }
}
