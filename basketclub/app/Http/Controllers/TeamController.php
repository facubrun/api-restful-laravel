<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Show all teams from table teams.
     */
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams, 200);
    }

    /**
     * Show a team by id.
     */
    public function show(int $id) 
    {
        $team = Team::find($id);
        if($team) {
            return response()->json($team, 200);
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }

    /**
     * Show a team games by id.
     */
    public function show_games(int $id) 
    {
        $team = Team::find($id);
        if($team) {
            return response()->json($team->games, 200);
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }

    /**
     * Store a new team in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:128',
            'category' => 'required|max:128',
            'gender' => 'required|in:Male,Female,Mixed',
        ]);

        $team = new Team();

        $team->name = $validated['name'];
        $team->category = $validated['category'];
        $team->gender = $validated['gender'];

        $team->save();

        $data = [
            'message' => 'Team created successfully',
            'team' => $team
        ];

        return response()->json($data, 201);
    }

    /**
     * Update a team in the database.
     */
    public function update(Request $request, int $id) 
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|max:128',
            'category' => 'sometimes|required|max:128',
            'gender' => 'sometimes|required|in:Male,Female,Mixed',
        ]);

        $team = Team::find($id);
        if($team) {
            // si la validacion es correcta y el player existe, actualizo los campos
            if (isset($validated['name'])) {
                $team->name = $validated['name'];
            }
            if (isset($validated['category'])) {
                $team->category = $validated['category'];
            }
            if (isset($validated['gender'])) {
                $team->gender = $validated['gender'];
            }

            // guardo los cambios
            $team->save();

            $data = [
                'message' => 'Team updated successfully',
                'team' => $team
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }

    /**
     * Delete a team from the database.
     */
    public function destroy(int $id) 
    {
        $team = Team::find($id);
        if($team) {
            // eliminar team de la bd
            $team->delete();
            return response()->json(['message' => 'Team with id ' . $id . ' deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }

    /**
     * Show team(s) with games.
     */
    public function show_teams_with_games(?int $id = null) 
    {
        if ($id == null){
            $teams = Team::with('games')->get();
            return response()->json($teams, 200);
        } else {
            $team = Team::with('games')->find($id);
            if ($team) {
                return response()->json($team, 200);
            } else {
                return response()->json(['message' => 'Team not found'], 404);
            }
        }
    }

    public function show_last_game(int $id) 
    {
        $team = Team::find($id);
        if ($team) {
            $lastGame = $team->latestGame;
            if ($lastGame) {
                return response()->json($lastGame, 200);
            } else {
                return response()->json(['message' => 'No games found for this team'], 404);
            }
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }

    /**
     * Get players by team id.
     */
    public function show_players(int $id) 
    {
        $team = Team::find($id);
        if($team) {
            return response()->json($team->players, 200);
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }
}
