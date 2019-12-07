<?php
namespace App\Repositories;

use App\Post;

class PostRepository implements Repository {
  public function all() {
    return Post::all();
  }
  public function create(Array $data) {
    return Post::create(array_merge(
      $data,
      ['user_id' => auth()->user()->id]
  ));
  }
  public function delete($id) {
    return Post::destroy($id);
  }
  public function update(Array $data, $id) {
    return $this->show($id)->update($data);
  }
  public function show($id) {
    return Post::find($id);
  }
}