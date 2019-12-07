<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created()
    {
        $this->actingAs($user = factory(User::class)->create())
            ->post('/posts', [
                'title' => 'post',
                'body' => 'body'
            ]);

        $posts = Post::all();
        $this->assertCount(1, $posts);
        $this->assertEquals($user->id, $posts->first()->user_id);
    }

    /** @test */
    public function a_post_can_be_deleted() {
        $this->actingAs($user = factory(User::class)->create())
            ->post('/posts', [
                'title' => 'post',
                'body' => 'body'
            ]);
        
            
        $createdPost = Post::all()->first();
            
        $response = $this->actingAs($user)
            ->delete("posts/$createdPost->id");
        
        $posts = Post::all();

        $this->assertCount(0, $posts);
        $response->assertExactJson([
            'success' => true,
        ]);
    }

    /** @test */
    public function a_post_can_be_deleted_only_by_owner() {
        $not_owner = factory(User::class)->create();
        $this->actingAs(factory(User::class)->create())
            ->post('/posts', [
                'title' => 'post',
                'body' => 'body'
            ]);
        Auth::logout();
        $allPosts = Post::all();
            
        $response = $this->actingAs($not_owner)
            ->delete('posts/'.$allPosts->first()->id);
        
        $posts = Post::all();

        $this->assertCount(1, $posts);
        $response->assertOk();
        
        $response->assertExactJson([
            'success' => false,
            'message' => 'Not authorized'
        ]);
    }

    /** @test */
    public function a_post_can_be_edited() {
        $this->actingAs($user = factory(User::class)->create())
            ->post('/posts', [
                'title' => 'post',
                'body' => 'body'
            ]);
        
        $editData = [
            'title' => 'post edit',
            'body' => 'body edit',
        ];

        $response = $this->actingAs($user)
            ->put('posts/1', $editData);
        
        $response->assertOk();

        $post = Post::find(1);
        
        $this->assertEquals('post edit', $post->title);
        $this->assertEquals('body edit', $post->body);
        
        $response->assertExactJson([
            'success' => true
        ]);
    }

    /** @test */
    public function a_post_can_be_edited_only_by_owner() {
        $not_owner = factory(User::class)->create();
        $this->actingAs(factory(User::class)->create())
            ->post('/posts', [
                'title' => 'post',
                'body' => 'body'
            ]);

        Auth::logout();
        
        $editData = [
            'title' => 'post edit',
            'body' => 'body edit',
        ];

        $response = $this->actingAs($not_owner)
            ->put('posts/1', $editData);
        
        $response->assertStatus(401);
        $response->assertExactJson([
            'success' => false,
            'message' => 'Action unauthorized',
        ]);
    }
}
