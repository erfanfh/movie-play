<?php

namespace App\Actions\Profile;

use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends Action
{
    public function handle($validated): void
    {
        Auth::user()->update($validated);
    }
}
