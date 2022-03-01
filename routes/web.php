<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/admin/login', [AdminController::class, 'login'])->name('adminLogin');
Route::post('/admin/login', [AdminController::class, 'doLogin']);

Route::middleware('auth.admin')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('adminDashboard');
    Route::get('/admin/settings/add-vehicle', [AdminController::class, 'showAddVehicle'])->name('addVehicle');

    Route::get('admin/settings/vehicle-categories', [AdminController::class, 'showManageVehicleCategories'])->name('manageVehicleCategories');
    Route::post('admin/settings/vehicle-categories', [AdminController::class, 'createVehicleCategory']);

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('adminLogout');
});