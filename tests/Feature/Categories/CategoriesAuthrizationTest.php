<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesAuthrizationTest extends TestCase
{

    public function test_guest_cannot_access_categories_page(): void
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
    public function test_guest_cannot_access_category_create_page(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
    public function test_guest_cannot_store_category(): void
    {
        $category = [
            'name' => 'Test Category',
            'description' => 'Test description'
        ];
        $response = $this->post(route('admin.categories.store', $category));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
    public function test_guest_cannot_access_category_show_page(): void
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.show', $category));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
    public function test_guest_cannot_access_category_edit_page(): void
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.edit', $category));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
    public function test_guest_cannot_update_category(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'Test Category',
            'description' => 'Test description'
        ];
        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }

    public function test_guest_cannot_delete_category(): void
    {
        $category = Category::factory()->create();
        $response = $this->delete(route('admin.categories.destroy', $category));

        $response->assertStatus(302)
            ->assertRedirect(route('admin.login'));
    }
}
