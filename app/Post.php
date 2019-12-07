<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public static function createPostRule() {
        return [
            'title' => 'required',
            'body' => 'required',
        ];
    }
}
