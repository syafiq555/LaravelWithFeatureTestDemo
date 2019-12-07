<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirect_to_hompage_if_not_logged_in()
    {
        $this->get('/')->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_register() {
        $this->post('/register', [
            'email' => 'user@user.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'name' => 'syafiq shamsuddin'
        ]);
        $users = User::all();
        $this->assertCount(1, $users);
    }
}
