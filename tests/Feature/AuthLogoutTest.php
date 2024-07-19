<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthLogoutTest extends TestCase
{
    /**
     * When random visitor logout
     */
    #[Test]
    public function when_rando_logout(): void
    {
        $response = $this->get('/logout');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');

        $response = $this->post('/logout', []);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    /**
     * When admin logout
     */
    #[Test]
    public function when_admin_logout(): void
    {
        $response = $this->actingAs($this->admin)->get('/logout');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');

        $response = $this->actingAs($this->admin)->post('/logout', []);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    /**
     * When seller logout
     */
    #[Test]
    public function when_seller_logout(): void
    {
        $response = $this->actingAs($this->seller)->get('/logout');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');

        $response = $this->actingAs($this->seller)->post('/logout', []);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }

    /**
     * When user logout
     */
    #[Test]
    public function when_user_logout(): void
    {
        $response = $this->actingAs($this->user)->get('/logout');
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');

        $response = $this->actingAs($this->user)->post('/logout', []);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('login');
    }
}
