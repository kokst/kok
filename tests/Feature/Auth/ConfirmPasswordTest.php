<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;

class ConfirmPasswordTest extends TestCase
{
    protected function confirmPasswordRoute()
    {
        return route('password.confirm');
    }

    public function testUserCanViewTheConfirmPasswordFormIfAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get($this->confirmPasswordRoute());

        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.confirm');
    }
}
