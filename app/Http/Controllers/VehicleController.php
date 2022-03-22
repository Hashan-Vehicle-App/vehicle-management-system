<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Vehicle;

class VehicleController extends Controller
{

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
            return back()->with('success', 'Vehicle successfully created.');
        }
    }

    public function updateVehicle($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicleNo' => 'required|min:7|max:8',
            'vehicleCategory' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $vehicle = Vehicle::find($id);

        $vehicle->vehicle_no = $request->vehicleNo;
        $vehicle->category_id = $request->vehicleCategory;

        $result = $vehicle->save();

        if ($result) {
            return back()->with('success', 'Vehicle successfully updated.');
        }
    }
}
