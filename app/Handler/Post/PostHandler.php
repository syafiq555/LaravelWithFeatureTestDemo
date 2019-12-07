<?php
namespace App\Handler\Post;

use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;

class PostHandler extends Controller {
  protected $repository;
  public function __construct(PostRepository $postRepository)
  {
    $this->repository = $postRepository;
  }
}