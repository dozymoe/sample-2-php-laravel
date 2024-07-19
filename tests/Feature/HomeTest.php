<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * When random visits home
     */
    #[Test]
    public function when_rando_visit_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->post('/', []);
        $response->assertStatus(405);
    }

    /**
     * When admin visits home
     */
    #[Test]
    public function when_admin_visit_home(): void
    {
        $response = $this->actingAs($this->admin)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($this->admin)->post('/', []);
        $response->assertStatus(405);
    }

    /**
     * When seller visits home
     */
    #[Test]
    public function when_seller_visit_home(): void
    {
        $response = $this->actingAs($this->seller)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($this->seller)->post('/', []);
        $response->assertStatus(405);
    }

    /**
     * When user visits home
     */
    #[Test]
    public function when_user_visit_home(): void
    {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->post('/', []);
        $response->assertStatus(405);
    }
}
