<?php

namespace Tests\Feature\Categories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesUpdatingTest extends TestCase
{
    use RefreshDatabase;

    // protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->admin = Admin::factory()->create();
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function test_check_if_edit_category_page_open_successfully_and_contains_right_data(): void
    {
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.edit', $category));
        $response->assertStatus(200)
            ->assertViewIs('admin.categories.edit')
            ->assertViewHas('category', $category)
            ->assertSee($category->name)
            ->assertSee($category->description);
    }

    public function test_updating_category(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'Updated Category Name',
            'description' => 'Updated description'
        ];

        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);


        $response->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', 'Category updated successfully');

        $this->assertDatabaseHas('categories', $updatedCategory);
        $this->assertDatabaseMissing('categories', $category->toArray());
    }

    public function test_check_category_name_is_required_in_update(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => '',
            'description' => 'Updated description'
        ];

        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);


        $response->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required.');

        $this->assertDatabaseMissing('categories', $updatedCategory);
        $this->assertDatabaseHas('categories', $category->toArray());
    }
    public function test_check_category_name_at_least_3_characters_in_update(): void
    {
        $category = Category::factory()->create();

        $updatedCategory = ['description' => 'Test description', 'name' => 'ab'];
        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);



        $response->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $updatedCategory);
        $this->assertDatabaseHas('categories', $category->toArray());
    }
    public function test_check_category_name_max_255_characters_in_update(): void
    {
        $updatedCategory = ['description' => 'Test description', 'name' => str_repeat('a', 256)];
        $category = Category::factory()->create();

        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);



        $response->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $updatedCategory);
        $this->assertDatabaseHas('categories', $category->toArray());
    }

    public function test_check_category_description_is_optional_in_update(): void
    {
        $updatedCategory = ['name' => 'Test name'];
        $category = Category::factory()->create();

        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);

        $response->assertStatus(302)
            ->assertSessionHas('success', 'Category updated successfully')
            ->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', $updatedCategory);
        $this->assertDatabaseMissing('categories', $category->toArray());
    }
    public function test_check_category_description_max_1000_characters_in_update(): void
    {
        $updatedCategory = ['description' => str_repeat('a', 1001), 'name' => 'Test name'];
        $category = Category::factory()->create();

        $response = $this->patch(route('admin.categories.update', $category), $updatedCategory);

        $response->assertStatus(302)
            ->assertSessionHasErrors('description');
        $this->assertDatabaseMissing('categories', $updatedCategory);
        $this->assertDatabaseHas('categories', $category->toArray());
    }
}
