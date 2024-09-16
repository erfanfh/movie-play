<?php

namespace App\Actions\Memory;

use App\Actions\Action;
use App\Models\Memory;

class CreateMemory extends Action
{
    public function handle($jsonNumbers) : Memory
    {
        return Memory::create([
            'user_id' => auth()->user()->id,
            'score' => 0,
            'current_question' => 0,
            'is_active' => 1,
            'order' => $jsonNumbers
        ]);
    }
}
