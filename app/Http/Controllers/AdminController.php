<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Location;

use Inertia\Inertia;

class AdminController extends Controller
{

    public function showLogin()
    {

        if (Auth::check()) {
            // If user logged in already
            return redirect()->route('admin.dashboard');
        }

        return Inertia::render('Auth/AdminLoginPage');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $request->username)->first();

        if (!($user && $user->user_role == 'admin')) {
            return Redirect::back()->withErrors(['message' => 'Invalid user'])->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::intended(route('admin.dashboard'));
        }

        return Redirect::back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('admin.login');
    }

    public function showVehicleCategories()
    {
        $vehicleCategories = (new VehicleCategoryController)->index();
        return Inertia::render('admin/PageVehicleCategories', ['vehicleCategories' => $vehicleCategories]);
    }

    public function showVehicles()
    {
        $vehicles = (new VehicleController)->index();
        $vehicleCategories = (new VehicleCategoryController)->index();
        return Inertia::render('admin/PageVehicles', ['vehicles' => $vehicles, 'vehicleCategories' => $vehicleCategories]);
    }

    public function showLocations()
    {
        $locations = (new LocationController)->index();
        return Inertia::render('admin/PageLocations', ['locations' => $locations]);
    }

    public function showReports()
    {
        $vehicleRequests = (new VehicleRequestController)->listByStatus('approved');
        return Inertia::render('admin/PageReports', ['vehicleRequests' => $vehicleRequests]);
    }

    public function showForgotPassword()
    {
        return Inertia::render('ForgotPassword');
    }
}
