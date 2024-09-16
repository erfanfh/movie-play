<?php

namespace App\Actions\Password;

use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class UpdatePassword extends Action
{
    public function handle($request): void
    {
        Auth::user()->update([
            'password' => $request->password,
        ]);
    }
}
