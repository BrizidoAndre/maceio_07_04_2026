<?php

use App\Http\Controllers\NodeController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

//redirecting user to dialog page
Route::redirect('/', './dialog');

//dialog related functions
Route::get('/dialog', [PublicController::class, 'index'])->name('home');
//creating dialog records
Route::get('/dialog/create', [PublicController::class, 'create'])->name('create');
Route::post('/dialog/create', [PublicController::class, 'store'])->name('store');
//editing dialog records
Route::get('/dialog/edit/{dialog}', [PublicController::class, 'edit'])->name('edit');
Route::put('/dialog/edit/{dialog}', [PublicController::class, 'update'])->name('update');
Route::delete('/dialog/{dialog}', [PublicController::class, 'destroy'])->name('destroy');

// get node related functions
Route::get('/nodes/{node}', [NodeController::class, 'update'])->name('node.update');
Route::put('/nodes/{node}', [NodeController::class, 'edit'])->name('node.edit');
