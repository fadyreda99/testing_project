<?php

namespace Tests\Feature\Categories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryCreatingTest extends TestCase
{
    use RefreshDatabase;

    // protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->admin = Admin::factory()->create();
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function test_check_if_create_category_page_open_successfully(): void
    {
        $response = $this->get(route('admin.categories.create'));
        $response->assertStatus(200)
            ->assertViewIs('admin.categories.create')
            ->assertSee('categories')
            ->assertSee('Name')
            ->assertSee('Description');
    }

    public function test_creating_category(): void
    {
        $category = Category::factory()->make();
        $response = $this->post(route('admin.categories.store'), $category->toArray());


        $response->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', 'Category created successfully');

        $this->assertDatabaseHas('categories', $category->toArray());
    }

    public function test_check_category_name_is_required(): void
    {
        $category = ['description' => 'Test description'];
        $response = $this->post(route('admin.categories.store'), $category);


        $response->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required.');

        $this->assertDatabaseMissing('categories', $category);
    }
    public function test_check_category_name_at_least_3_characters(): void
    {
        $category = ['description' => 'Test description', 'name' => 'ab'];
        $response = $this->post(route('admin.categories.store'), $category);


        $response->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $category);
    }
    public function test_check_category_name_max_255_characters(): void
    {
        $category = ['description' => 'Test description', 'name' => str_repeat('a', 256)];
        $response = $this->post(route('admin.categories.store'), $category);


        $response->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $category);
    }

    public function test_check_category_description_is_optional(): void
    {
        $category = ['name' => 'Test name'];
        $response = $this->post(route('admin.categories.store'), $category);
        $response->assertStatus(302)
            ->assertSessionHas('success', 'Category created successfully')
            ->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', $category);
    }
    public function test_check_category_description_max_1000_characters(): void
    {
        $category = ['description' => str_repeat('a', 1001), 'name' => 'Test name'];
        $response = $this->post(route('admin.categories.store'), $category);
        $response->assertStatus(302)
            ->assertSessionHasErrors('description');
        $this->assertDatabaseMissing('categories', $category);
    }
}
