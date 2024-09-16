<?php

namespace App\Actions\User;

use App\Actions\Action;
use App\Models\User;

class CreateUser extends Action
{
    public function handle($validated)
    {
        return User::create($validated);
    }
}
