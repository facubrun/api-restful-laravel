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
        $players = Player::with('image')->get();
        return response()->json($players, 200);
    }

    /**
     * Show a player by id.
     */
    public function show(int $id) 
    {
        $player = Player::with('image')->find($id);
        if($player) {
            return response()->json($player, 200);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }

    /**
     * Show medical record of a player by player id.
     */
    public function show_medical_record(int $id) 
    {
        $player = Player::with('medicalRecord')->find($id);
        if($player) {
            return response()->json($player->medicalRecord, 200);
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

    /**
     * Update a player in the database.
     */
    public function update(Request $request, int $id) 
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|max:128',
            'last_name' => 'sometimes|required|max:128',
            'gender' => 'sometimes|required|in:Male,Female,Other',
            'date_birth' => 'sometimes|required|date|before:'. Carbon::now()->subYears(6),
        ]);

        $player = Player::find($id);
        if($player) {
            // si la validacion es correcta y el player existe, actualizo los campos
            if (isset($validated['first_name'])) {
                $player->first_name = $validated['first_name'];
            }
            if (isset($validated['last_name'])) {
                $player->last_name = $validated['last_name'];
            }
            if (isset($validated['gender'])) {
                $player->gender = $validated['gender'];
            }
            if (isset($validated['date_birth'])) {
                $player->date_birth = $validated['date_birth'];
            }

            // guardo los cambios
            $player->save();

            $data = [
                'message' => 'Player updated successfully',
                'player' => $player
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }

    /**
     * Delete a player from the database.
     */
    public function destroy(int $id) 
    {
        $player = Player::find($id);
        if($player) {
            // eliminar player de la bd
            $player->delete();
            return response()->json(['message' => 'Player with id ' . $id . ' deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }
}
