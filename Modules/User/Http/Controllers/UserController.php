<?php

namespace Modules\User\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = Cache::remember('users', 86400, function () {
            return User::with('roles')->get();
        });

        return view('vendor.kokst.core.resource.index', [
            'resource' => 'user',
            'collection' => $users,
            'header' => __('user::index.title'),
            'basic' => true,
            'title' => false,
            'activity' => false,
            'roles' => true,
            'extrafields' => [
                'name' => ['header' => 'Name', 'sort' => true],
                'email' => ['header' => 'Email', 'sort' => true],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vendor.kokst.core.resource.form', [
            'resource' => 'user',
            'type' => 'create',
            'namespace' => 'user',
            'basic' => true,
            'fields' => [
                'name' => ['type' => 'text', 'required' => true],
                'email' => ['type' => 'text', 'required' => true],
                'password' => ['type' => 'password', 'required' => true],
                'role' => [
                    'type' => 'select',
                    'collection' => Role::all()->sortBy('name')->pluck('name', 'id'),
                    'placeholder' => 'Bitte wählen',
                    'required' => true,
                ],
            ],
            'header' => __('user::create.title'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'role' => ['required'],
        ]);

        $role = Role::where('id', '=', request()->role)->firstOrFail()->name;

        $user = User::create([
            'name' => request()->input('name'),
            'email' => request()->input('email'),
            'password' => Hash::make(request()->input('password')),
        ]);

        $user->assignRole($role);

        return redirect('/user');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        if (isset($user->roles[0])) {
            $role = $user->roles[0]->id;
        }

        return view('vendor.kokst.core.resource.form', [
            'resource' => 'user',
            'type' => 'edit',
            'model' => $user,
            'namespace' => 'user',
            'softdelete' => false,
            'basic' => true,
            'fields' => [
                'name' => ['type' => 'text', 'required' => true],
                'email' => ['type' => 'text', 'required' => true],
                'role' => [
                    'type' => 'select',
                    'collection' => Role::all()->sortBy('name')->pluck('name', 'id'),
                    'placeholder' => 'Bitte wählen',
                    'required' => true,
                    'old' => $role ?? null,
                ],
            ],
            'header' => __('user::edit.title'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user): RedirectResponse
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => ['required'],
        ]);

        $user->update(request([
            'name',
            'email',
        ]));

        if (isset($user->roles[0])) {
            $oldRoleId = $user->roles[0]->id;
            $oldRole = Role::where('id', '=', $oldRoleId)->firstOrFail()->name;
            $user->removeRole($oldRole);
        }

        $role = Role::where('id', '=', request()->role)->firstOrFail()->name;
        $user->assignRole($role);
        $user->touch();

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect('/user');
    }
}
