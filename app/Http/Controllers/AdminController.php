<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
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

    public function showDashboard()
    {
        return Inertia::render('Dashboard/Index');
    }

    /* Manage vehicle categories */
    public function showManageLocations()
    {

        $locations = Location::all();

        return view('admin.settings.manageLocations', ['locations' => $locations]);
    }
}
