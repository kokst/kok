<?php

namespace Modules\User\Observers;

use App\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->id === User::first()->id) {
            $user->assignRole('Admin');
        }

        Cache::forget('users');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(): void
    {
        Cache::forget('users');
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(User $user)
    {
        if ($user->id === User::first()->id) {
            $user->assignRole('Admin');

            return false;
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(): void
    {
        Cache::forget('users');
    }
}
