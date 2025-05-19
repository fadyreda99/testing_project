<?php

namespace Tests\Feature\CategoriesApi;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    // protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->admin = Admin::factory()->create();
        // $this->actingAs(Admin::factory()->create(), 'api');

        $admin = Admin::factory()->create();

        // Generate a JWT token for the user
        $token = auth()->guard('api')->login($admin);

        // Set the authorization header for the requests
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }
    public function test_check_if_categroies_list_is_working(): void
    {
        Category::factory()->count(4)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(4, 'data');
    }
    public function test_create_category(): void
    {
        $category = Category::factory()->make();

        $response = $this->postJson('/api/categories', $category->toArray());

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => $category->name,
                'description' => $category->description,
            ]);
    }
    public function test_show_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $category->name,
                'description' => $category->description,
            ]);
    }
    public function test_update_category(): void
    {
        $category = Category::factory()->create();
        $updatedData = [
            'name' => 'Updated Category',
            'description' => 'Updated description',
        ];

        $response = $this->patchJson('/api/categories/' . $category->id, $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $updatedData['name'],
                'description' => $updatedData['description'],
            ]);
    }
    public function test_delete_category(): void
    {
        $category = Category::factory()->create();
        

        $response = $this->deleteJson('/api/categories/' . $category->id);

        $response->assertStatus(204)
           ;
    }
}
