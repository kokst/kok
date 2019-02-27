<?php

namespace Tests\Feature;

use Tests\TestCase;
use Kokst\Core\Http\User;
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
    
    public function testRedirectToLoginIfNotAuthenticated()
    {
        $response = $this->get($this->homeRoute());
        $response->assertRedirect($this->loginGetRoute());
    }
}