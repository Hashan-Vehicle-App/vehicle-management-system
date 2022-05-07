<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\VehicleCategory;
use App\Models\Vehicle;
use App\Models\VehicleRequest;
use Carbon\Carbon;
use Inertia\Inertia;

class VehicleController extends Controller
{

    public function index()
    {
        return Vehicle::with('category')->get();
    }

    public function create()
    {

        $vehicleCategories = VehicleCategory::all();

        return Inertia::render('Vehicles/Create', ['vehicleCategories' => $vehicleCategories]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicleNo' => 'required|min:7|max:8',
            'vehicleCategory' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Create new vehicle
        $newVehicle = new Vehicle;

        $newVehicle->vehicle_no = $request->vehicleNo;
        $newVehicle->category_id = $request->vehicleCategory;

        $result = $newVehicle->save();

        if ($result) {
            //return Redirect::back()->with('success', 'Vehicle successfully created.');
            return Redirect::back()->with('success', 'Vehicle created successfully');
        }
    }

    public function edit($id)
    {
        $vehicleCategories = VehicleCategory::all();

        $vehicles = Vehicle::all();
        $vehicle = $vehicles->find($id);

        return Inertia::render('Vehicles/Edit', ['vehicle' => $vehicle, 'vehicleCategories' => $vehicleCategories]);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicleNo' => 'required|min:7|max:8',
            'vehicleCategory' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $vehicle = Vehicle::find($id);

        $vehicle->vehicle_no = $request->vehicleNo;
        $vehicle->category_id = $request->vehicleCategory;

        $result = $vehicle->save();

        if ($result) {
            return Redirect::back()->with('success', 'Vehicle successfully updated.');
        }
    }

    public function getAvailableVehiclesToday()
    {
        $todayRequests = VehicleRequest::where('pickup_date', Carbon::today()->toDateString())->with('vehicle')->get()->toArray();

        $todayRequestedVehicleIds = array_map(fn ($request) => $request['vehicle_id'], $todayRequests);

        return Vehicle::whereNotIn('id', $todayRequestedVehicleIds)->with('category')->get();
    }

    public function getAvailableVehiclesByDate(Request $request)
    {
        $todayRequests = VehicleRequest::where('pickup_date', (new Carbon($request->query('date')))->toDateString())->with('vehicle')->get()->toArray();

        $todayRequestedVehicleIds = array_map(fn ($request) => $request['vehicle_id'], $todayRequests);

        return Vehicle::whereNotIn('id', $todayRequestedVehicleIds)->with('category')->get();
    }

    public function destroy($id)
    {
        Vehicle::destroy($id);

        return back()->with('delete', 'Vehicle successfully deleted.');
    }
}
