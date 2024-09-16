<?php

namespace App\Http\Controllers;

use App\Actions\Question\CreateQuestion;
use App\Actions\Question\UpdateQuestion;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class AdminQuestionController extends Controller
{
    public function questions(): View|Factory|Application
    {
        $questions = QueryBuilder::for(Question::class)
            ->defaultSort('-created_at')
            ->paginate(20);

        return view('admin.dashboard.questions.index', compact('questions'));
    }

    public function questionsPost(StoreQuestionRequest $request, CreateQuestion $createQuestion): RedirectResponse
    {
        $hash = substr(sha1(uniqid(mt_rand(), true)), 0, 16);

        $extension = $request->file('poster')->getClientOriginalExtension();

        if ($request->poster->storeAs($hash . "." . "$extension")) {
            $question = $createQuestion->question($request, $hash, $extension);

            $createQuestion->answer($request, $question);

            return redirect()->route('dashboard.questions')->with('success', 'Question created!');
        } else {
            return redirect()->route('dashboard.questions')->with('danger', 'Something went wrong!');
        }
    }

    public function questionShow(Question $question): View|Factory|Application
    {
        return view('admin.dashboard.questions.show', compact('question'));
    }

    public function questionsUpdate(UpdateQuestionRequest $request, Question $question, UpdateQuestion $updateQuestion): RedirectResponse
    {
        if ($request->hasFile('poster')) {
            unlink(public_path('images') . '/' . $question->image);

            $hash = substr(sha1(uniqid(mt_rand(), true)), 0, 16);

            $extension = $request->file('poster')->getClientOriginalExtension();

            if ($request->poster->storeAs($hash . "." . "$extension")) {
                $updateQuestion->image($question, $hash, $extension);
            } else {
                return redirect()->route('dashboard.questions', $question)->with('danger', 'Something went wrong!');
            }
        }

        $updateQuestion->title($request, $question);

        $updateQuestion->answer($request, $question);

        return redirect()->route('dashboard.questions.show', $question)->with('success', 'Question Edited!');
    }

    public function questionsDestroy(Question $question): RedirectResponse
    {
        unlink(public_path('images') . '/' . $question->image);

        $question->delete();

        return redirect()->route('dashboard.questions');
    }
}
