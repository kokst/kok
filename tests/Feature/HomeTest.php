<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected function homeRoute()
    {
        return route('home');
    }

    protected function loginGetRoute()
    {
        return route('login');
    }

    protected function loginPostRoute()
    {
        return route('login');
    }

    public function testRedirectToLoginIfNotAuthenticated()
    {
        $response = $this->get($this->homeRoute());
        $response->assertRedirect($this->loginGetRoute());
    }

    public function testUserCanViewHomeIfAuthenticated()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect($this->homeRoute());
        $this->assertAuthenticatedAs($user);

        $response = $this->get($this->homeRoute());
        $response->assertStatus(200);
    }
}
