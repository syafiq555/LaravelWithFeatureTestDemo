<?php

namespace App\Handler\Post;

use App\Post;
use Illuminate\Http\Request;

class UpdatePostHandler extends PostHandler
{
    public function __invoke(Request $request, Post $post)
    {
      if(auth()->user()->id != $post->user_id)
        return response()->json([
            'success' => false,
            'message' => 'Action unauthorized',
        ], 401);

        $this->repository->update($request->validated(), $post->id);

        return response()->json([
            'success' => true,
        ]);
    }
}
