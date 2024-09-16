<?php

namespace App\Actions\Question;

use App\Actions\Action;
use App\Models\Question;

class CreateQuestion extends Action
{
    public function question($request, $hash, $extension) : Question
    {
         return Question::create([
            'title' => $request->answer,
            'image' => $hash . "." . "$extension",
        ]);
    }

    public function answer($request, $question): void
    {
        $question->answer()->create([
            'text' => $request->answer,
            'is_correct' => 1,
        ]);
    }
}
