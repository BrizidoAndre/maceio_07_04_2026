<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

//public routes
Route::get('/', [PublicController::class, 'login'])->name('login');
Route::post('/logon', [PublicController::class, 'logon'])->name('logon');
Route::get('/logout', [PublicController::class, 'logout'])->name('logout');
Route::get('/register', [PublicController::class, 'register'])->name('public.register');
Route::post('/register', [PublicController::class, 'signup'])->name('public.signup');

//needs to be authenticated
Route::middleware('auth')->group(function () {
//    orders related routes
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::put('/orders/{order}', [OrderController::class, 'status'])->name('order.status');
    Route::get('/orders/{order}/{status}', [OrderController::class, 'statusLink'])->name('order.link');
//    products related routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
//    promocodes related routes
    Route::get('/promocodes', [PromocodeController::class, 'index'])->name('promocodes.index');
    Route::post('/promocodes', [PromocodeController::class, 'store'])->name('promocodes.store');
    Route::put('/promocodes/update/{promocode}', [PromocodeController::class, 'update'])->name('promocodes.update');
    Route::get('/promocodes/delete/{promocode}', [PromocodeController::class, 'destroy'])->name('promocodes.destroy');
//    rating related routes
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
});
