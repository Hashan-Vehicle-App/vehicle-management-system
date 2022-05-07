<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Location;
use App\Models\VehicleRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        $availableVehicles = Vehicle::where('status', 'available')->with('category')->get();
        $locations = Location::all();
        $vehicleRequests = VehicleRequest::with('vehicle.category', 'pickupLocation', 'deliverLocation')->get();

        $props = array();

        if ($user->user_role == 'admin') {
            $props['userRole'] = $user->user_role;
            $props['vehicleRequests'] = $vehicleRequests;
            return Inertia::render('AdminDashboard', $props);
        } else if ($user->user_role == 'client') {
            $availableVehiclesToday = (new VehicleController)->getAvailableVehiclesToday();

            $props['userRole'] = $user->user_role;
            $props['availableVehiclesToday'] = $availableVehiclesToday;
            $props['locations'] = $locations;

            return Inertia::render('ClientDashboard', $props);
        }
    }
}
