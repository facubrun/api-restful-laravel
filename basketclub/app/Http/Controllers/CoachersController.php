<?php

namespace App\Http\Controllers;

use App\Models\Coacher;
use App\Models\Team;
use Illuminate\Http\Request;

class CoachersController extends Controller
{
    /**
     * Display a listing of all coachers.
     */
    public function index()
    {
        $coachers = Coacher::with('teams')->get();
        return response()->json($coachers, 200);
    }

    /**
     * Store a newly created coacher in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:128',
            'last_name' => 'required|string|max:128',
            'birth_date' => 'required|date',
            'nationality' => 'nullable|string|max:64',
            'years_experience' => 'nullable|integer|min:0',
        ]);

        $coacher = Coacher::create($validated);

        return response()->json([
            'message' => 'Coacher created successfully',
            'coacher' => $coacher
        ], 201);
    }

    /**
     * Display the specified coacher.
     */
    public function show(int $id)
    {
        $coacher = Coacher::with('teams')->find($id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        return response()->json($coacher, 200);
    }

    /**
     * Update the specified coacher in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:128',
            'last_name' => 'sometimes|string|max:128',
            'birth_date' => 'sometimes|date',
            'nationality' => 'sometimes|nullable|string|max:64',
            'years_experience' => 'sometimes|nullable|integer|min:0',
        ]);

        $coacher = Coacher::find($id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        $coacher->update($validated);

        return response()->json([
            'message' => 'Coacher updated successfully',
            'coacher' => $coacher
        ], 200);
    }

    /**
     * Remove the specified coacher from storage.
     */
    public function destroy(int $id)
    {
        $coacher = Coacher::find($id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        $coacher->delete();

        return response()->json(['message' => 'Coacher deleted successfully'], 200);
    }

    /**
     * Get all teams for a specific coacher.
     */
    public function show_teams(int $id)
    {
        $coacher = Coacher::with('teams')->find($id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        return response()->json([
            'coacher' => $coacher->first_name . ' ' . $coacher->last_name,
            'teams' => $coacher->teams
        ], 200);
    }

    /**
     * Attach a coacher to a team.
     */
    public function attach_team(Request $request, int $coacher_id, int $team_id)
    {
        $coacher = Coacher::find($coacher_id);
        $team = Team::find($team_id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        // Validar datos opcionales de la relación
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Verificar si ya existe la relación
        if ($coacher->teams()->where('team_id', $team_id)->exists()) {
            return response()->json(['message' => 'Coacher is already assigned to this team'], 400);
        }

        $coacher->teams()->attach($team_id, $validated);

        return response()->json([
            'message' => 'Coacher assigned to team successfully',
            'coacher' => $coacher->load('teams')
        ], 200);
    }

    /**
     * Detach a coacher from a team.
     */
    public function detach_team(int $coacher_id, int $team_id)
    {
        $coacher = Coacher::find($coacher_id);

        if (!$coacher) {
            return response()->json(['message' => 'Coacher not found'], 404);
        }

        if (!$coacher->teams()->where('team_id', $team_id)->exists()) {
            return response()->json(['message' => 'Coacher is not assigned to this team'], 400);
        }

        $coacher->teams()->detach($team_id);

        return response()->json([
            'message' => 'Coacher removed from team successfully'
        ], 200);
    }
}
