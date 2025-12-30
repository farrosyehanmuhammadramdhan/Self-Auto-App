<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleMasterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SparepartsController;
use App\Http\Controllers\TechniciansController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceMasterController;
use App\Http\Controllers\StockController;

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
Route::resource('spareparts', SparepartsController::class);
Route::resource('technicians', TechniciansController::class);
Route::resource('sales', SalesController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('services-masters', ServiceMasterController::class);
Route::resource('services', ServiceController::class);
Route::resource('stock', StockController::class);


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('welcome');
});