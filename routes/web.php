<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostumersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});

Route::resource('costumers', CostumersController::class);