<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
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
