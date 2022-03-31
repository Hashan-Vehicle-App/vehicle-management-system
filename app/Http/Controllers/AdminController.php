<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\VehicleCategory;
use App\Models\Vehicle;
use App\Models\Location;

class AdminController extends Controller
{

    public function login()
    {

        if (Auth::check()) {
            // If user logged in already
            return redirect()->route('adminDashboard');
        }

        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $request->username)->first();

        if (!($user && $user->user_role == 'admin')) {
            return back()->withInput()->withErrors(['message' => 'Invalid user']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('adminDashboard'));
        }

        return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('adminLogin');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    /* Manage Vehicles */
    public function showManageVehicles()
    {

        $vehicleCategories = VehicleCategory::all();
        $vehicles = Vehicle::with('category')->get();

        return view('admin.settings.manageVehicles', [
            'vehicleCategories' => $vehicleCategories,
            'vehicles' => $vehicles
        ]);
    }

    public function showEditVehicle($id)
    {
        $vehicleCategories = VehicleCategory::all();

        $vehicles = Vehicle::all();
        $vehicle = $vehicles->find($id);

        return view('admin.settings.editVehicle', ['vehicle' => $vehicle, 'vehicleCategories' => $vehicleCategories]);
    }
    /* End */

    /* Manage vehicle categories */
    public function showManageVehicleCategories()
    {

        $vehicleCategories = VehicleCategory::all();

        return view('admin.settings.manageVehicleCategories', ['vehicleCategories' => $vehicleCategories]);
    }

    public function showEditVehicleCategory($id)
    {

        $vehicleCategory = VehicleCategory::find($id);

        return view('admin.settings.editVehicleCategory', ['vehicleCategory' => $vehicleCategory]);
    }

    /* Manage vehicle categories */
    public function showManageLocations()
    {

        $locations = Location::all();

        return view('admin.settings.manageLocations', ['locations' => $locations]);
    }
}
