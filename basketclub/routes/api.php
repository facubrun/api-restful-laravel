<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([ApiForceAcceptHeader::class])->group(function () {
    // listado de players
Route::get('/players', [PlayerController::class, 'index']);
// busqueda de player por id
Route::get('/players/{id}', [PlayerController::class, 'show']);
// alta de nuevo player
Route::post('/players', [PlayerController::class, 'store']);
});

// listado de teams    
Route::get('/teams', [TeamController::class, 'index'])
    ->middleware([ApiForceAcceptHeader::class]);