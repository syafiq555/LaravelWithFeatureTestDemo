<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Handler\Post\CreatePostHandler;
use App\Handler\Post\DeletePostHandler;
use App\Handler\Post\UpdatePostHandler;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {

    }

    public function store(PostRequest $request, CreatePostHandler $createPostHandler)
    {
        return $createPostHandler($request);
    }

    public function destroy(Post $post, DeletePostHandler $deletePostHandler) {
        return $deletePostHandler($post);
    }

    public function update(PostRequest $request, Post $post, UpdatePostHandler $updatePostHandler) {
        return $updatePostHandler($request, $post);
    }
}
