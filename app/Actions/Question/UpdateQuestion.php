<?php

namespace App\Actions\Question;

use App\Actions\Action;

class UpdateQuestion extends Action
{
    public function image($question, $hash, $extension): void
    {
        $question->update([
            'image' => $hash . "." . "$extension",
        ]);
    }

    public function title($request, $question): void
    {
        $question->update([
            'title' => $request->answer,
        ]);
    }

    public function answer($request, $question): void
    {
        $question->answer()->update([
            'text' => $request->answer,
        ]);
    }
}
