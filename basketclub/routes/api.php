<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/players', function (Request $request) {
    return 'Lista de jugadores';
});
