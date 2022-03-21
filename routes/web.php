<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('adminLogin');
Route::post('/admin/login', [AdminController::class, 'doLogin']);

Route::middleware('auth.admin')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('adminDashboard');
    Route::get('/admin/settings/vehicles', [AdminController::class, 'showManageVehicles'])->name('manageVehicles');
    Route::post('/admin/settings/vehicles', [AdminController::class, 'createVehicle'])->name('createVehicle');
    Route::get('admin/settings/vehicle-categories', [AdminController::class, 'showManageVehicleCategories'])->name('manageVehicleCategories');
    Route::post('admin/settings/vehicle-categories', [AdminController::class, 'createVehicleCategory']);
    
    Route::post('/logout', [UserController::class, 'logout'])->name('userLogout');
});

// Client
Route::get('/client/login', [ClientController::class, 'login'])->name('clientLogin');
Route::post('/client/login', [ClientController:: class, 'doLogin']);

Route::middleware('auth.client')->group(function() {
    Route::get('/client/dashboard', [ClientController::class, 'showDashboard'])->name('clientDashboard');
    
    Route::post('/logout', [UserController::class, 'logout'])->name('userLogout');
});