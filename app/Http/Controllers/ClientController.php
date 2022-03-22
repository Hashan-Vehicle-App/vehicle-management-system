<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\VehicleCategory;
use App\Models\Vehicle;

class ClientController extends Controller
{
    public function login()
    {

        if (Auth::check()) {
            // If user logged in already
            return redirect()->route('clientDashboard');
        }

        return view('client.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $request->username)->first();

        if (!($user && $user->user_role == 'client')) {
            return back()->withInput()->withErrors(['message' => 'Invalid user']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('clientDashboard'));
        }

        return back()->withInput()->withErrors(['message' => 'Invalid credentials']);
    }

    public function showDashboard()
    {
        // Get only categories that has active vehicles
        $vehicleCategories = VehicleCategory::whereHas('vehicles', function ($query) {
            $query->where('vehicles.status', 'available');
        })->get();

        return view('client.dashboard', [
            'vehicleCategories' => $vehicleCategories
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('clientLogin');
    }
}
