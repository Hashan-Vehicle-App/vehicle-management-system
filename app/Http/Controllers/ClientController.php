<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function showLogin()
    {

        if (Auth::check()) {
            // If user logged in already
            //return redirect()->route('clientDashboard');
            return Redirect::route('client.dashboard');
        }

        return Inertia::render('Auth/ClientLoginPage');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $request->username)->first();

        if (!($user && $user->user_role == 'client')) {
            return Redirect::back()->withErrors(['message' => 'Invalid user'])->withInput();
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::intended(route('client.dashboard'));
        }

        return Redirect::back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function showDashboard()
    {
        // Get only categories that has active vehicles
        $vehicleCategories = VehicleCategory::whereHas('vehicles', function ($query) {
            $query->where('vehicles.status', 'available');
        })->get();

        // Get locations
        $locations = Location::all();

        // return view('client.dashboard', [
        //     'vehicleCategories' => $vehicleCategories, 'locations' => $locations
        // ]);

        return Inertia::render('Dashboard/Index');
    }

    public function showVehicleRequest()
    {
        $locations = Location::all();

        $availableVehiclesToday = (new VehicleController)->getAvailableVehiclesToday();

        $props = array();
        $props['availableVehiclesToday'] = $availableVehiclesToday;
        $props['locations'] = $locations;

        return Inertia::render('client/RequestVehicle', $props);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('client.login');
    }
}
