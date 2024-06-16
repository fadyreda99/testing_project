<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_user_logged_in(): void
    {
        $user = User::create([
            'name' => 'fady',
            'email' => 'fady@fady.com',
            'password' => bcrypt('123456'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
