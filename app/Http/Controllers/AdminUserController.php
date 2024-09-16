<?php

namespace App\Http\Controllers;

use App\Actions\User\UpdateUser;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class AdminUserController extends Controller
{
    public function users(): View|Factory|Application
    {
        $users = QueryBuilder::for(User::class)
            ->defaultSort('-created_at')
            ->paginate(20);

        return view('admin.dashboard.users.index', compact('users'));

    }

    public function userShow(User $user): View|Factory|Application
    {
        return view('admin.dashboard.users.show', compact('user'));
    }

    public function userUpdate(UpdateUserRequest $request, User $user, UpdateUser $updateUser): RedirectResponse
    {
        $validated = $request->validated();

        $updateUser->update($user, $validated);

        return redirect()->route('dashboard.users.show', $user)->with('success', 'User updated!');
    }

    public function userPasswordUpdate(UpdateUserPasswordRequest $request, User $user, UpdateUser $updateUser): RedirectResponse
    {
        $validated = $request->validated();

        $updateUser->update($user, $validated);

        return redirect()->route('dashboard.users.show', $user)->with('success', 'Password Changed!');
    }

    public function userDestroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('dashboard.users');
    }
}
