<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user)
    {
        return $user
            ->roles()
            ->where(function ($query) {
                $query->where('name', 'ADMIN')
                    ->orWhere('name', 'MANAGER');
            })
            ->exists();
    }

    public function destroy(User $user)
    {
        return $user
            ->roles()
            ->where('name', 'ADMIN')
            ->exists();
    }

}
