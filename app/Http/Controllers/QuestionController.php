<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        if ($memory == null) {
            $rows = Question::select('id')->get();
            $ids = $rows->pluck('id')->toArray();
            shuffle($ids);
            $jsonNumbers = json_encode($ids);
            $memory = Memory::create([
                'user_id' => auth()->user()->id,
                'score' => 0,
                'current_question' => 0,
                'is_active' => 1,
                'order' => $jsonNumbers
            ]);
        }

        if (!$memory->first()->updated_at->lt(Carbon::now()->addDays(7))) {
            $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();
            $memory->update([
                'is_active' => 0,
            ]);
        }

        if ($memory->current_question == count(Question::all())) {
            $memory->update([
                'is_active' => 0,
            ]);
            return view('game.result')->with(['message' => 'Congrats, you finished the game! Wait for more levels', 'score' => $memory->score]);
        }

        $question = Question::find(json_decode($memory->order)[$memory->current_question]);

        return view('game.question', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

    public function checkAnswer(Request $request, Question $question)
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        if(!$memory) {
            return redirect()->route('home');
        }

        if (trim(ucwords($question->answer->text)) == trim(ucwords($request->answer))) {
            $memory->update([
                'score' => $memory->score + 1,
                'current_question' => $memory->current_question + 1,
            ]);
            $memory->questions()->save($question);
            return redirect()->route('question.show');
        } else {
            $memory->update([
                'is_active' => 0,
            ]);
            return view('game.result')->with(['message' => 'Your answer was wrong, Game Over!', 'score' => $memory->score]);
        }
    }

    public function playover()
    {
        $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

        $memory->update([
            'is_active' => 0,
        ]);

        return redirect()->route('question.show');
    }
}
