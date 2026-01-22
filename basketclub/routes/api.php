<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoachersController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\CheckTokenForAnyScope;

Route::middleware([ApiForceAcceptHeader::class])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Rutas GET - Accesibles con user:read o user:all
Route::middleware([
    ApiForceAcceptHeader::class, 
    'auth:api', 
    CheckTokenForAnyScope::using(['user:read', 'user:all'])
])->group(function () {
    // user routes
    Route::get('/users/{id}/medical-record', [MedicalRecordController::class, 'show_user_medical_record']);

    // players routes
    Route::get('/players', [PlayerController::class, 'index']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::get('players/{id}/medical-record', [PlayerController::class, 'show_medical_record']);

    // teams routes
    Route::get('/teams', [TeamController::class, 'index']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    Route::get('teams/{id}/games', [TeamController::class, 'show_games']);
    Route::get('/teams/{id}/players', [TeamController::class, 'show_players']);
    Route::get('/teams-with-games/{id?}', [TeamController::class, 'show_teams_with_games']);
    Route::get('/teams/{id}/last-game', [TeamController::class, 'show_last_game']);

    // games routes
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/{id}', [GameController::class, 'show']);
    Route::get('games/{id}/team', [GameController::class, 'show_team']);

    // medical records routes
    Route::get('/medical-records', [MedicalRecordController::class, 'index']);
    Route::get('/medical-records/{id}', [MedicalRecordController::class, 'show']);
    Route::get('medical-records/{id}/player', [MedicalRecordController::class, 'show_player']);

    // statistics routes
    Route::get('/statistics', [StatisticsController::class, 'index']);

    // coachers routes
    Route::get('/coachers', [CoachersController::class, 'index']);
    Route::get('/coachers/{id}', [CoachersController::class, 'show']);
    Route::get('/coachers/{id}/teams', [CoachersController::class, 'show_teams']);
});

// Rutas POST, PUT, DELETE - Solo accesibles con user:all
Route::middleware([
    ApiForceAcceptHeader::class, 
    'auth:api', 
    'scopes:user:all'
])->group(function () {
    // players routes
    Route::post('/players', [PlayerController::class, 'store']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);
    Route::post('/players/{id}/medical-records', [PlayerController::class, 'store_player_medical_record']);

    // teams routes
    Route::post('/teams', [TeamController::class, 'store']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
    Route::post('/teams/{id}/players/{player_id}', [TeamController::class, 'store_player']);

    // games routes
    Route::post('/games', [GameController::class, 'store']);

    // medical records routes
    Route::delete('/medical-records/{id}', [MedicalRecordController::class, 'destroy']);

    // statistics routes
    Route::post('/statistics', [StatisticsController::class, 'store']);
    Route::put('/statistics/{id}', [StatisticsController::class, 'update']);
    Route::delete('/statistics/{id}', [StatisticsController::class, 'destroy']);

    // coachers routes
    Route::post('/coachers', [CoachersController::class, 'store']);
    Route::put('/coachers/{id}', [CoachersController::class, 'update']);
    Route::delete('/coachers/{id}', [CoachersController::class, 'destroy']);
    Route::post('/coachers/{coacher_id}/teams/{team_id}', [CoachersController::class, 'attach_team']);
    Route::delete('/coachers/{coacher_id}/teams/{team_id}', [CoachersController::class, 'detach_team']);
});
