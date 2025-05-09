<?php

namespace Tests\Feature\Categories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesDeletingTest extends TestCase
{
    use RefreshDatabase;

    // protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->admin = Admin::factory()->create();
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    public function test_deleting_category(): void
    {
        $category = Category::factory()->create();


        $response = $this->delete(route('admin.categories.destroy', $category));


        $response->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('success', 'Category deleted successfully');

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
