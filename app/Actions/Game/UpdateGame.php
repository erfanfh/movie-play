<?php

namespace App\Actions\Game;

use App\Actions\Action;

class UpdateGame extends Action
{
    public function handle($memory): void
    {
        $memory->update([
            'is_active' => 0,
        ]);
    }
}
