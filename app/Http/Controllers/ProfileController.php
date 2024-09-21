<?php

namespace App\Http\Controllers;

use App\Actions\Password\UpdatePassword;
use App\Actions\Profile\UpdateProfile;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Memory;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class ProfileController extends Controller
{
    public function profile(): View|Factory|Application
    {
        $bestRecord = QueryBuilder::for(Memory::class)
            ->where('user_id', Auth::id())
            ->defaultSort('-score')
            ->first();

        return view('auth.profile', compact('bestRecord'));
    }

    public function editProfile(): View|Factory|Application
    {
        return view('auth.editProfile');
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateProfile $updateProfile): RedirectResponse
    {
        $validated = $request->validated();

        $updateProfile->handle($validated);

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request, UpdatePassword $updatePassword): RedirectResponse
    {
        if (!Hash::check($request->old_password, auth()->user()->getAuthPassword())) {
            return redirect()->route('profile.edit')->with('message', 'Old password is incorrect');
        }

        $updatePassword->handle($request);

        return redirect()->route('logout');
    }

    public function userProfile(string $username): Factory|Application|View|RedirectResponse
    {
        $user = QueryBuilder::for(User::class)
            ->where('username', $username)
            ->firstOrFail();

        if (auth()->user() == $user) {
            return redirect()->route('profile');
        }

        $memories = QueryBuilder::for(Memory::class)
            ->where('user_id', $user->id)
            ->defaultSort('-created_at')
            ->paginate(10);

        $bestRecord = QueryBuilder::for(Memory::class)
            ->where('user_id', $user->id)
            ->defaultSort('-score')
            ->first();

        return view('user.profile', compact('user'), compact('memories', 'bestRecord'));
    }
}
