<?php

use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('OrderMenu');
});
Route::get('popular', [MenuItemController::class, 'getMostPopular']);
Route::get('menu-items', [MenuItemController::class, 'index']);
Route::get('menu-items/{id}', [MenuItemController::class, 'show']);
Route::post('menu-items', [MenuItemController::class, 'store']);
Route::put('menu-items/{id}', [MenuItemController::class, 'update']);
Route::delete('menu-items/{id}', [MenuItemController::class, 'destroy']);
Route::get('/newest', [MenuItemController::class, 'getNewest']);
Route::get('/favorite', [MenuItemController::class, 'getHighlyRated']);