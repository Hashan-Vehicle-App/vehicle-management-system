<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\VehicleCategory;
use Inertia\Inertia;

class VehicleCategoryController extends Controller

{

    public function index()
    {
        return VehicleCategory::all();
    }

    public function create()
    {
        return Inertia::render('VehicleCategories/Create');
    }

    public function store(Request $request)
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
        $newVehicleCategory->slug = Str::slug($request->vehicleCategoryName, '-');

        $result = $newVehicleCategory->save();

        if ($result) {
            return Redirect::route('vehicleCategory.index');
        }
    }

    public function edit($id)
    {

        $vehicleCategory = VehicleCategory::find($id);

        return Inertia::render('VehicleCategories/Edit', ['vehicleCategory' => $vehicleCategory]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicleCategoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Find vehicle category
        $vehicleCategory = VehicleCategory::find($id);

        $vehicleCategory->title = $request->vehicleCategoryName;
        $vehicleCategory->slug = Str::slug($request->vehicleCategoryName, '-');

        $result = $vehicleCategory->save();

        if ($result) {
            return Redirect::route('vehicleCategory.index')->with('success', 'Vehicle category successfully updated.');
        }
    }

    public function destroy($id)
    {
        VehicleCategory::destroy($id);

        return Redirect::route('vehicleCategory.index')->with('delete', 'Vehicle category successfully deleted.');
    }
}
