<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\VehicleCategory;

class VehicleCategoryController extends Controller
{
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
            return back()->with('success', 'Vehicle category successfully created.');
        }
    }

    public function updateVehicleCategory($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicleCategoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new vehicle category
        $vehicleCategory = VehicleCategory::find($id);

        $vehicleCategory->title = $request->vehicleCategoryName;

        $result = $vehicleCategory->save();

        if ($result) {
            return back()->with('success', 'Vehicle category successfully updated.');
        }
    }

    public function deleteVehicleCategory($id)
    {
        VehicleCategory::destroy($id);

        return back()->with('delete', 'Vehicle category successfully deleted.');
    }
}
