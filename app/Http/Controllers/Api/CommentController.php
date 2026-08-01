<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
     public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500'
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $id,
            'comment' => $request->comment
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $comment
        ], 201);
    }
}
