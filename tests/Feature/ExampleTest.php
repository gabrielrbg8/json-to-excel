<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test to create an user
     *
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->post('api/users', [
            'name' => 'Gabriel',
            'email' => 'gabrielrbg8@outlook.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(201);
    }
}
