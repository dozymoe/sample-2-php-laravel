<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    /**
     * When random visitor login
     */
    #[Test]
    public function when_rando_login(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login',
            ['username' => 'baduser', 'password' => 'badpass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    /**
     * When admin login
     */
    #[Test]
    public function when_admin_login(): void
    {
        $response = $this->post('/login',
            ['username' => 'admin@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');

        $response = $this->post('/login',
            ['email' => 'admin@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
    }

    /**
     * When seller login
     */
    #[Test]
    public function when_seller_login(): void
    {
        $response = $this->post('/login',
            ['username' => 'seller@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');

        $response = $this->post('/login',
            ['email' => 'seller@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
    }

    /**
     * When user login
     */
    #[Test]
    public function when_user_login(): void
    {
        $response = $this->post('/login',
            ['username' => 'user@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');

        $response = $this->post('/login',
            ['email' => 'user@demo.com', 'password' => 'pass']);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');
    }
}
