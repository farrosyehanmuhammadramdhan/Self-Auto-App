<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleMasterController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('customers', CustomerController::class);
Route::resource('vehicle-masters', VehicleMasterController::class);
Route::resource('categories', CategoriesController::class);

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard');


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('welcome');
});