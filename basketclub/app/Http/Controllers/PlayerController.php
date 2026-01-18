<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
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
}
