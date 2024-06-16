<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
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
}
