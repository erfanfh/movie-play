<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

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

    public function adminRegisterPost(StoreAdminRequest $request): RedirectResponse
    {
        if ($request->key != 'e3b0c44298f') {
            return redirect()->route('admin.register')->with('message', 'The provided key was not correct!');
        }

        $validated = $request->validated();

        $user = User::create($validated);

        $user->is_admin = 1;

        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function dashboard(): View|Factory|Application
    {
        return view('admin.dashboard.dashboard');
    }

    public function questions(): View|Factory|Application
    {
        $questions = QueryBuilder::for(Question::class)
            ->defaultSort('-created_at')
            ->paginate(20);

        return view('admin.dashboard.questions.index', compact('questions'));
    }

    public function questionsPost(StoreQuestionRequest $request): RedirectResponse
    {
        $hash = substr(sha1(uniqid(mt_rand(), true)), 0, 16);

        $extension = $request->file('poster')->getClientOriginalExtension();

        if($request->poster->storeAs($hash . "." . "$extension")) {
            $question = Question::create([
                'title' => $request->answer,
                'image' => $hash . "." . "$extension",
            ]);

            $question->answer()->create([
                'text' => $request->answer,
                'is_correct' => 1,
            ]);

            return redirect()->route('dashboard.questions')->with('success', 'Question created!');
        } else {
            return redirect()->route('dashboard.questions')->with('danger', 'Something went wrong!');
        }
    }

    public function questionShow(Question $question): View|Factory|Application
    {
        return view('admin.dashboard.questions.show', compact('question'));
    }

    public function questionsUpdate(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        if ($request->hasFile('poster')) {
            unlink(public_path('images') . '/' . $question->image);

            $hash = substr(sha1(uniqid(mt_rand(), true)), 0, 16);

            $extension = $request->file('poster')->getClientOriginalExtension();

            if($request->poster->storeAs($hash . "." . "$extension")) {
                $question->update([
                    'image' => $hash . "." . "$extension",
                ]);
            } else {
                return redirect()->route('dashboard.questions', $question)->with('danger', 'Something went wrong!');
            }
        }

        $question->update([
            'title' => $request->answer,
        ]);

        $question->answer()->update([
            'text' => $request->answer,
        ]);

        return redirect()->route('dashboard.questions.show', $question)->with('success', 'Question Edited!');
    }

    public function questionsDestroy(Question $question): RedirectResponse
    {
        unlink(public_path('images') . '/' . $question->image);

        $question->delete();

        return redirect()->route('dashboard.questions');
    }

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

    public function userUpdate(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $user->update($validated);

        return redirect()->route('dashboard.users.show', $user)->with('success', 'User updated!');
    }

    public function userPasswordUpdate(UpdateUserPasswordRequest $request ,User $user): RedirectResponse
    {
        $validated = $request->validated();

        $user->update($validated);

        return redirect()->route('dashboard.users.show', $user)->with('success', 'Password Changed!');
    }

    public function userDestroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('dashboard.users');
    }
}
