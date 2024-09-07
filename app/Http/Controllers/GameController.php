<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Carbon\Carbon;

class GameController extends Controller
{
    public function index()
    {
        $memories = QueryBuilder::for(Memory::class)
            ->where('user_id', Auth::id())
            ->where('is_active', 1)
            ->get();

        if ($memories->all()) {
            if (!$memories->first()->updated_at->lt(Carbon::now()->addDays(7))) {
                $memory = Memory::where('user_id', auth()->user()->id)->where('is_active' , 1)->first();

                $memory->update([
                    'is_active' => 0,
                ]);
            }
        }

        return view('game.index', compact('memories'));
    }
}
