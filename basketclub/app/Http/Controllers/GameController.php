<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
   /**
     * Show all players from table players.
     */
    public function index()
    {
        $games = Game::all();
        return response()->json($games, 200);
    }

    /**
     * Show a game by id.
     */
    public function show(int $id) 
    {
        $game = Game::find($id);
        if($game) {
            return response()->json($game, 200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }
}
