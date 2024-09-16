<?php

namespace App\Actions\Admin;

use App\Actions\Action;
use App\Models\User;

class CreateAdmin extends Action
{
    public function create($validated): User
    {
        return User::create($validated);
    }

    public function admin($user): void
    {
        $user->is_admin = 1;

        $user->save();
    }
}
