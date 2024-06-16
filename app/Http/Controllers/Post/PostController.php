<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::rememberForever('posts', function () {
            return Post::take(1000)->get();
        });
        // $posts = Post::take(1000)->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required',
        ]);
        $user = auth()->user();
        Post::create([
            'post' => $request->post,
            'user_id' => $user->id
        ]);
        return redirect('/posts');
    }


    /*
    **tre2a b3alg beha l array
    */
    public function testCollection()
    {
        $arr = ['taylor', 'abigail', 'test'];
        // $collection = collect($arr)->map(function (?string $name) {
        //     return strtoupper($name);
        // })->reject(function (string $name) {
        //     return empty($name);
        // });

        // dd($collection);

        //////////////////////////////////////////////////////////////////////////////
        //create custom method in collection 
        //lazm  $collection yb2a f ay service provider 3lshan tb2a l new method global 3la l project kolo 
        // $collection = Collection::macro('toUpperCasing', function () {
        //     return $this->map(function ($item) {
        //         return strtoupper($item);
        //     });
        // });

        // $data = collect($arr)->toUpperCasing();
        // dd($data->all());


        //////////////////////////////////////////////////////////////////////

        // collections vs lazy collections
        //lazy collectoin take memory less than collection

        //this collection way  
        $posts = Post::take(10000)->get()->filter(function ($post) {
            return $post->id > 500;
        });

        //this lazy collection way 
        // $posts = Post::take(10000)->cursor()->filter(function ($post) {
        //     return $post->id > 500;
        // });
        dump(get_class($posts));
        return view('posts.index', compact('posts'));
    }
}
