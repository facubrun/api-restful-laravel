<?php

use App\Http\Controllers\PlayerController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// listado de players
Route::get('/players', [PlayerController::class, 'index'])
    ->middleware([ApiForceAcceptHeader::class]);
