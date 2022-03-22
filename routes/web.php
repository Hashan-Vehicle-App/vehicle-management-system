<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleCategoryController;

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

Route::middleware('auth.admin')->group(function () {
    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('adminDashboard');

    // Admin setting routes
    Route::get('/admin/settings/vehicles', [AdminController::class, 'showManageVehicles'])->name('manageVehicles');
    Route::get('admin/settings/vehicle-categories', [AdminController::class, 'showManageVehicleCategories'])->name('manageVehicleCategories');
    Route::get('admin/settings/edit-vehicle/{id}', [AdminController::class, 'showEditVehicle'])->name('showEditVehicle');
    Route::get('admin/settings/edit-vehicle-category/{id}', [AdminController::class, 'showEditVehicleCategory'])->name('showEditVehicleCategory');

    // Vehicle routes
    Route::post('/vehicles', [VehicleController::class, 'createVehicle'])->name('createVehicle');
    Route::put('/vehicles/{id}', [VehicleController::class, 'updateVehicle'])->name('updateVehicle');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'deleteVehicle'])->name('deleteVehicle');

    // Vehicle category routes
    Route::post('/vehicle-categories', [VehicleCategoryController::class, 'createVehicleCategory'])->name('createVehicleCategory');
    Route::put('/vehicle-categories/{id}', [VehicleCategoryController::class, 'updateVehicleCategory'])->name('updateVehicleCategory');
    Route::delete('/vehicle-categories/{id}', [VehicleCategoryController::class, 'deleteVehicleCategory'])->name('deleteVehicleCategory');

    // Other
    Route::post('/logout', [UserController::class, 'logout'])->name('userLogout');
});

// Client
Route::get('/client/login', [ClientController::class, 'login'])->name('clientLogin');
Route::post('/client/login', [ClientController::class, 'doLogin']);

Route::middleware('auth.client')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'showDashboard'])->name('clientDashboard');

    Route::post('/logout', [UserController::class, 'logout'])->name('userLogout');
});
