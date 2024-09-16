<?php

namespace App\Http\Controllers;

use App\Actions\Admin\CreateAdmin;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminLogin(): View|Factory|Application
    {
        return view('admin.auth.login');
    }

    public function adminRegister(): View|Factory|Application
    {
        return view('admin.auth.register');
    }

    public function adminRegisterPost(StoreAdminRequest $request, CreateAdmin $createAdmin): RedirectResponse
    {
        if ($request->key != 'e3b0c44298f') {
            return redirect()->route('admin.register')->with('message', 'The provided key was not correct!');
        }

        $validated = $request->validated();

        $user = $createAdmin->create($validated);

        $createAdmin->admin($user);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function dashboard(): View|Factory|Application
    {
        return view('admin.dashboard.dashboard');
    }

    public function profile(): View|Factory|Application
    {
        return view('admin.dashboard.profile.profile');
    }
}
