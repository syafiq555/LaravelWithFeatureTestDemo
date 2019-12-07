<?php

namespace App\Handler\Post;

use App\Post;

class DeletePostHandler extends PostHandler
{
    public function __invoke(Post $post)
    {
        if (auth()->user()->id == $post->user_id)
            $this->repository->delete($post->id);
        else
            return response()->json([
                'success' => false,
                'message' => 'Not authorized',
            ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
