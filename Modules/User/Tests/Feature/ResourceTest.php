<?php

namespace Modules\User\Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function createGetRoute()
    {
        return route('user.create');
    }

    protected function editGetRoute($id)
    {
        return route('user.edit', $id);
    }

    protected function createPostRoute()
    {
        return route('user.store');
    }

    protected function destroyPostRoute()
    {
        return route('user.destroy');
    }

    protected function indexRoute()
    {
        return route('user.index');
    }

    protected function loginGetRoute()
    {
        return route('login');
    }

    protected function logoutGetRoute()
    {
        return route('logout');
    }

    protected function loginPostRoute()
    {
        return route('login');
    }

    public function testRedirectToLoginIfNotAuthenticated()
    {
        $response = $this->get($this->createGetRoute());
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

        $this->assertAuthenticatedAs($user);

        $response = $this->get($this->createGetRoute());
        $response->assertStatus(200);
    }

    public function testUserCanViewEditIfAuthenticated()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $response = $this->get($this->editGetRoute($user->id));
        $response->assertStatus(200);
    }

    public function testCanCreateIfAuthenticated()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $userToCreate = factory(User::class)->make([
            'password' => 'i-love-laravel',
        ]);

        $this->assertNull(User::whereEmail($userToCreate->email)->first());

        $userToCreateBody = [
            'name' => $userToCreate->name,
            'email' => $userToCreate->email,
            'password' => $userToCreate->password,
            'role' => 1,
        ];

        $response = $this->call('POST', '/user/', $userToCreateBody, ['_token' => csrf_token()]);

        $response->assertStatus(302);
        $response = $this->get($this->indexRoute());

        $this->assertNotNull(User::whereEmail($userToCreate->email)->first());

        $createdUser = User::whereEmail($userToCreate->email)->first();

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($createdUser->name, $userToCreate->name);
        $this->assertEquals($createdUser->email, $userToCreate->email);
    }

    public function testCanUpdateIfAuthenticated()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $this->assertEquals(User::first()->name, $user->name);

        $userToUpdate = User::first();

        $userToUpdateBody = [
            'name' => $userToUpdate->name.' 2.0',
            'email' => $userToUpdate->email,
            'role' => 1,
        ];

        $response = $this->call('PUT', '/user/'.$userToUpdate->id, $userToUpdateBody, ['_token' => csrf_token()]);

        $response->assertStatus(302);
        $response = $this->get($this->indexRoute());

        $this->assertEquals(User::first()->name, $userToUpdateBody['name']);
    }

    public function testCanDeleteIfAuthenticated()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $user2 = factory(User::class)->create();

        $response = $this->call('DELETE', '/user/'.$user2->id, ['_token' => csrf_token()]);

        $response->assertStatus(302);
        $response = $this->get($this->indexRoute());

        $this->assertDatabaseMissing('users', [
            'id' => $user2->id,
        ]);
    }

    public function testFirstUserCannotBeDeleted()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $response = $this->call('DELETE', '/user/'.$user->id, ['_token' => csrf_token()]);

        $response->assertStatus(302);
        $response = $this->get($this->indexRoute());

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    public function testFirstUserStillHasAdminRoleAfterDeleteAttempt()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $this->assertEquals($user->roles->pluck('name')->implode(', '), 'Admin');

        $response = $this->call('DELETE', '/user/'.$user->id, ['_token' => csrf_token()]);

        $response->assertStatus(302);
        $response = $this->get($this->indexRoute());

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $this->assertNotNull(User::first());
        $user = User::first();

        $this->assertEquals($user->roles->pluck('name')->implode(', '), 'Admin');
    }

    public function testFirstUserHasAdminRole()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->assertEquals($user->roles->pluck('name')->implode(', '), 'Admin');
    }

    public function testSecondUserDoesNotHaveAdminRole()
    {
        $this->assertNull(User::first());

        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $user2 = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $this->assertStringNotContainsString('Admin', $user2->roles->pluck('name')->implode(', '));
    }

    public function testUserCanOnlyViewUserAdministrationIfHasAdminRole()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $response = $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $response = $this->get($this->indexRoute());
        $response->assertStatus(200);

        $response = $this->get($this->logoutGetRoute());
        $response->assertStatus(302);

        $user2 = factory(User::class)->create([
            'password' => Hash::make($password = 'i-love-laravel'),
        ]);

        $response2 = $this->post($this->loginPostRoute(), [
            'email' => $user2->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user2);

        $response2 = $this->get($this->indexRoute());
        $response2->assertStatus(403);
    }
}
