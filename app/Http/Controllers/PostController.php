<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Handler\Post\CreatePostHandler;
use App\Handler\Post\DeletePostHandler;

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
}
