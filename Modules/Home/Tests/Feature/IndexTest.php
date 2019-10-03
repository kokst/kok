<?php

namespace Modules\Home\Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function indexRoute()
    {
        return route('home.index');
    }

    protected function homeRoute()
    {
        return route('home.index');
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
        $response = $this->get($this->indexRoute());
        $response->assertRedirect($this->loginGetRoute());
    }

    public function testUserCanViewIndexIfAuthenticated()
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

        $response = $this->get($this->indexRoute());
        $response->assertStatus(200);
    }
}
