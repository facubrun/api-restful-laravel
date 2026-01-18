<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Show all players from table players.
     */
    public function index()
    {
        $players = Player::all();
        return response()->json($players, 200);
    }

    /**
     * Show a player by id.
     */
    public function show(int $id) 
    {
        $player = Player::find($id);
        if($player) {
            return response()->json($player, 200);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }

    /**
     * Store a new player in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:128',
            'last_name' => 'required|max:128',
            'gender' => 'required|in:Male,Female,Other',
            'date_birth' => 'required|date|before:'. Carbon::now()->subYears(6),
        ]);

        $player = new Player();

        $player->first_name = $validated['first_name'];
        $player->last_name = $validated['last_name'];
        $player->gender = $validated['gender'];
        $player->date_birth = $validated['date_birth'];

        $player->save();

        $data = [
            'message' => 'Player created successfully',
            'player' => $player
        ];

        return response()->json($data, 201);
    }
}
