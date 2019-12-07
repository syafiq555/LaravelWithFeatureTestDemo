<?php

namespace App\Handler\Post;
use Illuminate\Http\Request;

class CreatePostHandler extends PostHandler
{
    public function __invoke(Request $request)
    {
        $this->repository->create($request->validated());

        return response()->json([
            'success' => true,
        ]);
    }
}
