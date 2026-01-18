<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// listado de players
Route::get('/players', [PlayerController::class, 'index'])
    ->middleware([ApiForceAcceptHeader::class]);

Route::get('/teams', [TeamController::class, 'index'])
    ->middleware([ApiForceAcceptHeader::class]);