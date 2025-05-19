<?php

namespace Tests\Feature\CategoriesApi;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesAuthrizedTest extends TestCase
{
    public function test_prevent_unauthenticated_admins_from_retrieving_categories(): void
    {
        $response = $this->getJson('/api/categories');
        $response->assertStatus(401);

    }
    public function test_prevent_unauthenticated_admins_from_retrieving_one_category(): void
    {
        $response = $this->getJson('/api/categories/3');
        $response->assertStatus(401);

    }
    public function test_prevent_unauthenticated_admins_from_store_category(): void
    {
        $category = [
            'name' => 'Test Category',
            'description' => 'Test description'
        ];
        $response = $this->postJson('/api/categories', $category);
        $response->assertStatus(401);

    }
    public function test_prevent_unauthenticated_admins_from_update_category(): void
    {
        $category = [
            'name' => 'Test Category',
            'description' => 'Test description'
        ];
        $response = $this->patchJson('/api/categories/3', $category);
        $response->assertStatus(401);

    }
    public function test_prevent_unauthenticated_admins_from_delete_category(): void
    {
       
        $response = $this->patchJson('/api/categories/3');
        $response->assertStatus(401);

    }
}
