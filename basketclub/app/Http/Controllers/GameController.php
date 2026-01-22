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

    /**
     * Show a team by game id.
     */
    public function show_team(int $id) 
    {
        $game = Game::find($id);
        if($game) {
            return response()->json($game->team, 200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    /**
     * Store a new game in the database.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'is_home' => 'required|boolean',
            'game_date' => 'required',
            'pts_team' => 'required|integer|min:0',
            'pts_opponent' => 'required|integer|min:0',
            'team_id' => 'required|exists:teams,id',
            'opponent_name' => 'required|string|max:128'
        ]);

        $game = new Game();
        $game->fill($validated);
        $game->save();
        
        $data = [
            'message' => 'Game created successfully',
            'game' => $game  
        ];
        
        return response()->json($data, 201);
    }
}
