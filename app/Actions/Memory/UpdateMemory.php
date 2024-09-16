<?php

namespace App\Actions\Memory;

use App\Actions\Action;

class UpdateMemory extends Action
{
    public function handle($memory, $question): void
    {
        $memory->update([
            'score' => $memory->score + 1,
            'current_question' => $memory->current_question + 1,
        ]);

        $memory->questions()->save($question);
    }
}
