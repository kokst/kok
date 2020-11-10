<?php

namespace Modules\User\Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function indexRoute(): string
    {
        return route('user.index');
    }

    protected function homeRoute(): string
    {
        return route('home.index');
    }

    protected function loginGetRoute(): string
    {
        return route('login');
    }

    protected function loginPostRoute(): string
    {
        return route('login');
    }

    public function testRedirectToLoginIfNotAuthenticated(): void
    {
        $response = $this->get($this->indexRoute());
        $response->assertRedirect($this->loginGetRoute());
    }

    public function testUserCanViewIndexIfAuthenticated(): void
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
