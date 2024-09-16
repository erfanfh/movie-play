<?php

namespace App\Actions\Memory;

use App\Actions\Action;

class InactiveMemory extends Action
{
    public function handle($memory): void
    {
        $memory->update([
            'is_active' => 0,
        ]);
    }
}
