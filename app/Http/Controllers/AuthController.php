<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function loginPost(Request $request) : RedirectResponse
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            Auth::login(Auth::user());
            return redirect()->route('home');
        }

        return redirect()->route('login')->with('message', 'Login details are not valid');
    }

    public function register(): View|Factory|Application
    {
        return view('auth.register');
    }

    public function registerPost(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
