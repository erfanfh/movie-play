<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }
}
