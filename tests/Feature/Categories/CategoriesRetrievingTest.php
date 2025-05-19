<?php

namespace Tests\Feature\Categories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesRetrievingTest extends TestCase
{
    use RefreshDatabase;

    // protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->admin = Admin::factory()->create();
        $this->actingAs(Admin::factory()->create(), 'admin');
    }
    public function test_check_if_categroies_page_open_successfully(): void
    {
        

        $response = $this->get('/admin/categories');

        $response->assertStatus(200)
            ->assertViewIs('admin.categories.index')
            ->assertSee('categories');
    }

    public function test_check_if_categories_page_contains_categories(): void
    {
        $this->actingAs(Admin::factory()->create(), 'admin');
        Category::factory()->count(4)->create();
        

        $response = $this->get('/admin/categories');

        $response->assertViewIs('admin.categories.index')
            ->assertSee('categories');
            // ->assertViewHas('categories', function ($categories) {
            //     return $categories->count() === 4;
            // });
    }
    public function test_check_if_pagination_works(): void
    {
        $this->actingAs(Admin::factory()->create(), 'admin');
        Category::factory()->count(15)->create();
        

        $response = $this->get('/admin/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 10;
        });
        $response = $this->get('/admin/categories?page=2');
        // $response->assertViewHas('categories', function ($categories) {
        //     return $categories->count() === 5;
        // });
    }

    public function test_check_if_categroies_show_page_contain_right_data(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('admin.categories.show', $category));

        $response->assertStatus(200)
            ->assertViewIs('admin.categories.show')
            ->assertViewHas('category', $category)
            ->assertSeeText($category->name)
            ->assertSeeText($category->description)
            ->assertSee('categories');
    }
}
