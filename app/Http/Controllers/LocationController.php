<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Location;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index()
    {
        return Inertia::render('Locations/Index');
    }

    public function createLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locationName' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new vehicle category
        $newLocation = new Location;

        $newLocation->location_name = $request->locationName;

        $result = $newLocation->save();

        if ($result) {
            return back()->with('success', 'Location created successfully.');
        }
    }
}
