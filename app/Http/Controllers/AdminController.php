<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function login() {
        
        if (Auth::check()) {
            // If user logged in already
            return redirect()->route('adminDashboard');
        }

        return view('admin.login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('adminDashboard'));
        }

        return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('adminLogin');
    }

    public function showDashboard() {
        return view('admin.dashboard');
    }

    public function showAddVehicle() {
        return view('admin.addVehicle');
    }

    public function showManageVehicleCategories() {

        $vehicleCategories = VehicleCategory::all();

        return view('admin.settings.manageVehicleCategories', ['vehicleCategories' => $vehicleCategories]);
    }

    public function createVehicleCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'vehicleCategoryName' => ['required']
        ]);

        

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrive the validated input
        $validated = $validator->validated();

        // Create new vehicle category
        $newVehicleCategory = new VehicleCategory;

        $newVehicleCategory->title = $request->vehicleCategoryName;

        $result = $newVehicleCategory->save();

        if ($result) {
            return back()->with('success', 'Category was created!');
        }
    }
}