<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostumersController;
use App\Http\Controllers\VehicleMasterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard');

Route::resource('costumers', CostumersController::class);
Route::resource('master-vehicles', VehicleMasterController::class);