<?php

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreTableController;
use Illuminate\Support\Facades\Route;

// Menu Item routes

Route::get('popular', [MenuItemController::class, 'getMostPopular']);
Route::get('menu-items', [MenuItemController::class, 'index']);
Route::get('menu-items/{id}', [MenuItemController::class, 'show']);
Route::post('menu-items', [MenuItemController::class, 'store']);
Route::put('menu-items/{id}', [MenuItemController::class, 'update']);
Route::delete('menu-items/{id}', [MenuItemController::class, 'destroy']);
Route::get('/newest', [MenuItemController::class, 'getNewest']);
Route::get('/favorite', [MenuItemController::class, 'getHighlyRated']);
Route::post('/create-order', [OrderController::class, 'createOrder']);

// Staff related routes
Route::get('staff', [StaffController::class, 'index']);
Route::get('staff/{id}', [StaffController::class, 'show']);
Route::post('staff', [StaffController::class, 'store']);
Route::put('staff/{id}', [StaffController::class, 'update']);
Route::delete('staff/{id}', [StaffController::class, 'destroy']);

Route::post('store_tables', [StoreTableController::class, 'store']);

// Order related routes
Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{id}', [OrderController::class, 'show']);
Route::put('orders/{id}', [OrderController::class, 'update']);
Route::delete('orders/{id}', [OrderController::class, 'destroy']);
Route::post('create-order', [OrderController::class, 'createOrder']);