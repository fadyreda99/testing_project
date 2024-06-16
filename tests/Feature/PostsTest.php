<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    // use RefreshDatabase, WithFaker;
    use DatabaseTruncation;
    // use DatabaseMigrations;

    // in this test 1 func visit page without posts then go to 2 func insert record in db and test for not empty record then make refresh for db to delete the created record
    //actingAs like authenticate user 

    public function test_visit_empty_posts_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/posts');
        $response->assertSee('No posts found');
        $response->assertStatus(200);
    }

    public function test_visit_not_empty_posts_page()
    {
        $user = User::factory()->create();
        // $post =  Post::create(['post' => 'test post']);
        $post = Post::factory(20)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/posts');
        $response->assertDontSee(__('No posts found'));


        // $response->assertStatus(200);
        // $response->assertOk(); // status code 200
        // $response->assertAccepted(); // status code 202
        // $response->assertNotFound(); // status code 404 not found
        // $response->assertBadRequest(); // status code 400 bad request
        // $response->assertConflict(); // status code 409 conflict

        // dd($response->status()); //get current status code
        // dd($response->statusText()); //get current status text like "ok", "not found"

        //here check if a real data coming from db and check on pagination

        if ($response->status() == 200) {
            $response->assertViewHas('posts', function ($item) use ($post) {
                return $item->contains($post->first());
            });
        }
    }

    public function test_add_new_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/post/store', [
            'post' => 'test post',
        ]);

        //check if there is errors in session 
        // $response->assertSessionHasErrors();
        //check if there is no errors in session 
        // $response->assertSessionHasNoErrors();

        if ($response->assertSessionHasNoErrors()) {
            $response->assertRedirect('/posts');
        }
    }
}
