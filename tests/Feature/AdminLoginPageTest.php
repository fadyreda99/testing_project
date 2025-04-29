<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_check_if_admin_login_page_is_working(): void
    {

        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        // $response->assertViewIs('admin.auth.login');
        $response->assertSeeText('Welcome to admin Dashboard!');
    }
}
