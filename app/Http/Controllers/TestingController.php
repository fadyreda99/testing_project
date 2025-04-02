<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Image;
use App\Models\Phone;
use App\Models\Post;
use App\Models\Rule;
use App\Models\Scopes\StripeCoursesScope;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function testing()
    {
        // User::create([
        //     'name' => 'testing3',
        //     'email' => 'testing4@gmail.com',
        //     'password' => '123456789',
        // ]);

        //    upsert

        // $users = [
        //     ['name' => 'test1update', 'email' => 'test1@gmail.com', 'password' => '123456789000'],
        //     ['name' => 'test4', 'email' => 'test4@gmail.com', 'password' => '123456789'],
        // ];
        // User::upsert($users, ['email'], ['name', 'password']);
        //attribute internal state
        // dump($user->wasChanged());
        // dump($user->isDirty());
        // dump($user->isClean());

        // find or && find or fail
        // $user =  User::findOr(100, function () {
        //     return "user not found";
        // });
        // $user =  User::findOrFail(100);

        // first or && first or fail
        // $user =  User::where('id', 400)->firstOrFail();
        // $user =  User::where('id', 4)->firstOr(function(){
        //     return "user not found";
        // });
        ////////////////////////AGREGATES///////////////////
        // sum
        // $courses = Course::sum('price');
        // avg
        // $courses = Course::avg('price');
        // min and max
        // $courses = Course::min('price');
        // $courses = Course::max('price');

        // local scopes
        // $courses = Course::stripeCourses()->get();
        // global scopes
        // $courses = Course::get();
        // removing global scopes 
        // $courses = Course::withoutGlobalScopes([StripeCoursesScope::class])->get();


        // model events 
        // $course = Course::create([
        //     'name' => 'test course',
        //     'slug' => 'test-course2',
        //     'description' => 'test course description',
        //     'price' => 100,
        // ]);

        // mute model events
        // Course::withoutEvents(function () {
        //     $course = Course::create([
        //         'name' => 'test course',
        //         'slug' => 'test-course3',
        //         'description' => 'test course description',
        //         'price' => 100,
        //     ]);
        // });
        // dd($course);

        // relations
        // $phone = Phone::find(1);

        // $users = User::whereIn('id', [12])->get();
        // $phones = Phone::whereBelongsTo($users)->get();

        // $user = User::find(12);

        // has one through
        // $user = User::find(12);
        // $serial = $user->serial->serial;
        // has many through
        // $user = User::find(12);
        // $comments = $user->comments;

        // many to many 
        // $user = User::find(12);
        // $rules = $user->rules;

        // $rule = Rule::find(1);
        // foreach ($rule->users  as $user) {
        //     dump($user->pivot->created_at);
        // }


        // polymorphic relations
        // one to one
        // $user = User::find(12);
        // dd($user->image);
        // $post = Post::find(21);
        // dd($post->image);
        // $image = Image::find(2);
        // dd($image->imageable);

        // $user = User::create([
        //     'name' => 'test user',
        //     'email' => 'test1@example',
        //     'password' => '123456789',
        // ]);
        // $user->image()->create(['image_name' => 'test.jpg']);

        // $post = Post::create([
        //     'post_en' => 'test post',
        //     'post_ar' => 'test post',
        //     'user_id' => 12,
        // ]);
        // $post->image()->create(['image_name' => 'test.jpg']);

        // one to many
        // $post = Post::find(21);
        // dd($post->likes);

        // $video = Video::find(1);
        // dd($video->likes);

        // many to many 
        // $post = Post::find(21);
        // dd($post->tags);

        // $video = Video::find(1);
        // dd($video->tags);

        // $tag = Tag::find(2);
        // $posts = $tag->posts;
        // $videos = $tag->videos;

        // associate & disassociate
        // $post = Post::find(21);
        // $post->user()->associate(User::find(4));
        // $post->user()->disassociate();
        // $post->save();

        // attach & detach & sync
        // $user = User::find(12);
        // // $user->rules()->attach([1,2]);
        // // $user->rules()->detach();
        // $user->rules()->sync([2, 3, 4]);
        //     dd($user->rules()->pluck('rule_name')->toArray());

        //  $post= Post::find(21);

    //    return    $post = Post::create([
    //         'post_en' => 'test post',
    //         'post_ar' => 'test post',
    //         'user_id' => 12,
    //     ]);

    // data serialization
    $post= Post::find(21);
    // dd($post->toArray());
    dd($post->toJson());
        // dump($rule);
    }
}
