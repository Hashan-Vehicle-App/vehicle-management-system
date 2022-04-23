<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $availableVehicles = Vehicle::where('status', 'available')->with('category')->get();
        $locations = Location::all();

        $props = array();

        if ($user->user_role == 'admin') {
            $props['userRole'] = $user->user_role;
        } else if ($user->user_role == 'client') {
            $props['userRole'] = $user->user_role;
            $props['availableVehicles'] = $availableVehicles;
            $props['locations'] = $locations;
        }

        return Inertia::render('Dashboard/Index', $props);
    }
}
