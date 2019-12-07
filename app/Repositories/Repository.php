<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface Repository {
  public function all();
  public function create(Array $data);
  public function delete(Model $model);
  public function update(Array $data, Model $model);
  public function show(Model $model);
}