<?php

namespace App\Livewire;

use App\Models\Memory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\QueryBuilder\QueryBuilder;

class MemoryList extends Component
{
    public $memory;

    public $key;

    public $perPage = 10;

    public function loadMore(): void
    {
        $this->perPage += 5;
    }

    public function render(): Application|Factory|View
    {
        $memories = QueryBuilder::for(Memory::class)
            ->where('user_id', Auth::id())
            ->defaultSort('-created_at')
            ->paginate($this->perPage);

        return view('livewire.memory-list', compact('memories'));
    }
}
