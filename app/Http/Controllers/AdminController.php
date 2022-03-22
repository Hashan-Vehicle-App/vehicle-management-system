<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\VehicleCategory;
use App\Models\Vehicle;

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

    public function createVehicle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicleNo' => 'required|min:7|max:8',
            'vehicleCategory' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new vehicle
        $newVehicle = new Vehicle;

        $newVehicle->vehicle_no = $request->vehicleNo;
        $newVehicle->category_id = $request->vehicleCategory;

        $result = $newVehicle->save();

        if ($result) {
            return back()->with('success', 'Vehicle was created successfully!');
        }
    }
    /* End */

    /* Manage vehicle categories */
    public function showManageVehicleCategories()
    {

        $vehicleCategories = VehicleCategory::all();

        return view('admin.settings.manageVehicleCategories', ['vehicleCategories' => $vehicleCategories]);
    }

    public function createVehicleCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicleCategoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new vehicle category
        $newVehicleCategory = new VehicleCategory;

        $newVehicleCategory->title = $request->vehicleCategoryName;

        $result = $newVehicleCategory->save();

        if ($result) {
            return back()->with('success', 'Category was created!');
        }
    }
    /* End */
}
