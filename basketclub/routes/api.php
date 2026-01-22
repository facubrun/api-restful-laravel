<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([ApiForceAcceptHeader::class])->group(function () {

    //user routes
    Route::get('/users/{id}/medical-record', [MedicalRecordController::class, 'show_user_medical_record']);

    // players routes
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::get('players/{id}/medical-record', [PlayerController::class, 'show_medical_record']);
    Route::post('/players', [PlayerController::class, 'store']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);

    // teams routes
    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::get('teams/{id}/games', [TeamController::class, 'show_games']);
    Route::post('/teams', [TeamController::class, 'store']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
    Route::get('/teams/{id}/players', [TeamController::class, 'show_players']);
    Route::post('/teams/{id}/players/{player_id}', [TeamController::class, 'store_player']);

    // games routes
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::get('games/{id}/team', [GameController::class, 'show_team']);
    Route::post('/games', [GameController::class, 'store']);

    // medical records routes
    Route::get('/medical-records', [MedicalRecordController::class, 'index']);
    Route::get('/medical-records/{id}', [MedicalRecordController::class, 'show']);
    Route::get('medical-records/{id}/player', [MedicalRecordController::class, 'show_player']);
    Route::delete('/medical-records/{id}', [MedicalRecordController::class, 'destroy']);

    // create player medical record 
    Route::post('/players/{id}/medical-records', [PlayerController::class, 'store_player_medical_record']);

    // teams with games route
    Route::get('/teams-with-games/{id?}', [TeamController::class, 'show_teams_with_games']);
    Route::get('/teams/{id}/last-game', [TeamController::class, 'show_last_game']);


});
