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
}
