<?php

namespace App\Http\Controllers;

use App\Actions\Answers\checkAnswer;
use App\Actions\Memory\CreateMemory;
use App\Actions\Memory\InactiveMemory;
use App\Actions\Memory\UpdateMemory;
use App\Models\Memory;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function show(CreateMemory $createMemory, InactiveMemory $inactiveMemory) : View|Factory|Application
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        if ($memory == null) {
            $rows = Question::select('id')->get();
            $ids = $rows->pluck('id')->toArray();
            shuffle($ids);
            $jsonNumbers = json_encode($ids);
            $memory = $createMemory->handle($jsonNumbers);
        }

        if (!$memory->first()->updated_at->lt(Carbon::now()->addDays(7))) {
            $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();
            $inactiveMemory->handle($memory);
        }

        if ($memory->current_question == count(Question::all())) {
            $inactiveMemory->handle($memory);
            return view('game.result')->with(['message' => 'Congrats, you finished the game! Wait for more levels', 'score' => $memory->score]);
        }

        $question = Question::find(json_decode($memory->order)[$memory->current_question]);

        return view('game.question', ['question' => $question]);
    }
    public function checkAnswer(Request $request, Question $question, UpdateMemory $updateMemory, InactiveMemory $inactiveMemory, checkAnswer $checkAnswer): Factory|Application|View|RedirectResponse
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        if(!$memory) {
            return redirect()->route('home');
        }

        $similarity = $checkAnswer->handle($request->answer, $question->answer->text);

        if ($similarity >= 0.8) {
            $updateMemory->handle($memory, $question);
            return redirect()->route('question.show');
        } else {
            $inactiveMemory->handle($memory);
            return view('game.result')->with(['message' => 'Your answer was wrong, Games Over!', 'score' => $memory->score]);
        }
    }

    public function playover(InactiveMemory $inactiveMemory): RedirectResponse
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        $inactiveMemory->handle($memory);

        return redirect()->route('question.show');
    }
}
