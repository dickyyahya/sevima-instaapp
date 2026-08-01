<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Menampilkan semua post
    public function index()
    {
        return Post::with('user', 'likes', 'comments')
            ->latest()
            ->get();
    }

    // Menyimpan post baru
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = $request->file('image')->store('posts', 'public');

        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'image' => $image
        ]);

        return response()->json([
            'message' => 'Post berhasil dibuat',
            'data' => $post
        ], 201);
    }
}
