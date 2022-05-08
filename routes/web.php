<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleRequestController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome');
});

// Admin
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.attempt');

Route::middleware('auth.admin')->group(function () {
    // Admin routes
    Route::get('/admin/dashboard', [DashboardController::class, 'show'])->name('admin.dashboard');

    // Admin setting routes
    Route::get('admin/settings/vehicles', [AdminController::class, 'showVehicles'])->name('admin.vehicles.show');
    Route::get('admin/settings/vehicles/create', [VehicleController::class, 'create'])->name('vehicle.create');
    Route::get('admin/settings/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');

    Route::get('admin/settings/vehicle-categories', [AdminController::class, 'showVehicleCategories'])->name('admin.vehicleCategories.show');
    Route::get('admin/settings/vehicle-categories/create', [VehicleCategoryController::class, 'create'])->name('vehicleCategory.create');
    Route::get('admin/settings/vehicle-categories/{id}/edit', [VehicleCategoryController::class, 'edit'])->name('vehicleCategory.edit');

    Route::get('admin/settings/locations', [AdminController::class, 'showLocations'])->name('admin.locations.show');

    Route::get('admin/settings/edit-vehicle/{id}', [AdminController::class, 'showEditVehicle'])->name('showEditVehicle');
    Route::get('admin/settings/edit-vehicle-category/{id}', [AdminController::class, 'showEditVehicleCategory'])->name('showEditVehicleCategory');

    // Vehicle routes
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
    Route::get('/vehicles/available-by-date', [VehicleController::class, 'getAvailableVehiclesByDate'])->name('get-available-vehicles-by-date');

    // Vehicle category routes
    Route::post('/vehicle-categories', [VehicleCategoryController::class, 'store'])->name('vehicleCategory.store');
    Route::put('/vehicle-categories/{id}', [VehicleCategoryController::class, 'update'])->name('vehicleCategory.update');
    Route::delete('/vehicle-categories/{id}', [VehicleCategoryController::class, 'destroy'])->name('vehicleCategory.destroy');

    // Location routes
    Route::get('/locations/create', [LocationController::class, 'create'])->name('location.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('location.store');

    // Other
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Client
Route::get('/client/login', [ClientController::class, 'showLogin'])->name('client.login');
Route::post('/client/login', [ClientController::class, 'login'])->name('client.login.attempt');

Route::middleware('auth.client')->group(function () {
    Route::get('/client/dashboard', [DashboardController::class, 'show'])->name('client.dashboard');
    Route::get('/client/request-vehicle', [ClientController::class, 'showVehicleRequest'])->name('client.vehicleRequest.show');
    Route::post('/client/request-vehicle', [VehicleRequestController::class, 'store'])->name('vehicleRequest.store');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
