<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// api routes to be used in front end
Route::get('start/{dialog}', [ApiController::class, 'start']);
Route::get('next/{response}', [ApiController::class, 'next']);
