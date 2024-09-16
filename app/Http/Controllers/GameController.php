<?php

namespace App\Http\Controllers;

use App\Actions\Game\UpdateGame;
use App\Models\Memory;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class GameController extends Controller
{
    public function index(UpdateGame $updateGame): View|Factory|Application
    {
        $memories = QueryBuilder::for(Memory::class)
            ->where('user_id', Auth::id())
            ->where('is_active', 1)
            ->get();

        if ($memories->all()) {
            if (!$memories->first()->updated_at->lt(Carbon::now()->addDays(7))) {
                $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

                $updateGame->handle($memory);
            }
        }

        return view('game.index', compact('memories'));
    }
}
