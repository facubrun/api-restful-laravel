<?php

namespace App\Http\Controllers;

use App\Models\Statistics;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Statistics::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'games_played' => 'required|integer|min:0',
            'threes_made' => 'required|integer|min:0',
            'doubles_made' => 'required|integer|min:0',
            'free_throws_made' => 'required|integer|min:0',
        ]);

        $statistics = new Statistics();

        $statistics->fill($validated);
        $statistics->save();

        return response()->json($statistics, 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'player_id' => 'sometimes|exists:players,id',
            'games_played' => 'sometimes|integer|min:0',
            'threes_made' => 'sometimes|integer|min:0',
            'doubles_made' => 'sometimes|integer|min:0',
            'free_throws_made' => 'sometimes|integer|min:0',
        ]);

        $statistics = Statistics::find($id);
        if($statistics) {
            // si la validacion es correcta y el player existe, actualizo los campos
            if (isset($validated['games_played'])) {
                $statistics->games_played = $validated['games_played'];
            }
            if (isset($validated['threes_made'])) {
                $statistics->threes_made = $validated['threes_made'];
            }
            if (isset($validated['doubles_made'])) {
                $statistics->doubles_made = $validated['doubles_made'];
            }
            if (isset($validated['free_throws_made'])) {
                $statistics->free_throws_made = $validated['free_throws_made'];
            }

            // guardo los cambios
            $statistics->save();

            $data = [
                'message' => 'Statistics updated successfully',
                'statistics' => $statistics
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Statistics not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $statistics = Statistics::find($id);
        if($statistics) {
            $statistics->delete();
            return response()->json(['message' => 'Statistics with id ' . $id . ' deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Statistics not found'], 404);
        }
    }
}
