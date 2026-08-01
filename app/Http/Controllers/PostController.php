<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments.user', 'likes')
            ->latest()
            ->get();

        return view('dashboard', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = $request->file('image')->store('posts', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'image' => $image
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Post berhasil dibuat');
    }
      public function like(Post $post)
    {
        $sudahLike = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if (!$sudahLike) {

            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);

        }

        return back();
    }

    public function comment(Request $request, Post $post)
{
    $request->validate([
        'comment' => 'required'
    ]);

    Comment::create([
        'user_id' => Auth::id(),
        'post_id' => $post->id,
        'comment' => $request->comment
    ]);

    return back();
}
}
