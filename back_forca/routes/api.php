<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::any('/start', [GameController::class, 'start']);
Route::any('/{game}/end', [GameController::class, 'end']);
Route::any('/{game}/move', [GameController::class, 'move']);
Route::any('/{game}/computer', [GameController::class, 'computer']);
Route::any('/statistics', [GameController::class, 'statistics']);
