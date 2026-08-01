<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
     public function like(Request $request, $id)
    {
        $like = Like::firstOrCreate([
            'user_id' => $request->user()->id,
            'post_id' => $id
        ]);

        return response()->json([
            'message' => 'Post berhasil di-like',
            'data' => $like
        ]);
    }
}
