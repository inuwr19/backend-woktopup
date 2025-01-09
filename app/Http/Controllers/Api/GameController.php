<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('products')->get();
        return response()->json($games);
    }

    public function show($id)
    {
        $game = Game::with('products')->findOrFail($id);
        return response()->json($game);
    }

}

