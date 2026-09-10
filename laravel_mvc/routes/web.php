<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('login');
Route::post('/logon', [PublicController::class, 'logon'])->name('logon');
// protected functions
Route::middleware('auth')->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
//    products related routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//    order related routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/status/{order}/{status}', [OrderController::class, 'status'])->name('orders.status');
});
