<?php

namespace App\Actions\User;

use App\Actions\Action;

class UpdateUser extends Action
{
    public function update($user, $validated): void
    {
        $user->update($validated);
    }
}
