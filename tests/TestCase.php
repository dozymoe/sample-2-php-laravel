<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $admin;
    protected $seller;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::query()->where('email', 'admin@demo.com')->first();
        $this->seller = User::query()->where('email', 'seller@demo.com')->first();
        $this->user = User::query()->where('email', 'user@demo.com')->first();
    }
}
