<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class LeaderboardController extends Controller
{
    public function list()
    {
        $records = QueryBuilder::for(Memory::class)
            ->defaultSort('-score')
            ->paginate(50);

        return view('leaderboard.list', ['records' => $records]);
    }
}
