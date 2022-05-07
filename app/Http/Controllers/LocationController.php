<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index()
    {

        $locations = Location::all();

        return Inertia::render('Locations/Index', ['locations' => $locations]);
    }

    public function create()
    {
        return Inertia::render('Locations/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locationName' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();;
        }

        // Create new vehicle category
        $newLocation = new Location;

        $newLocation->name = $request->locationName;
        $newLocation->slug = Str::slug($request->locationName, '-');

        $result = $newLocation->save();

        if ($result) {
            return Redirect::route('location.index')->with('success', 'Location created successfully.');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locationName' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();;
        }

        // Create new vehicle category
        $newLocation = new Location;

        $newLocation->name = $request->locationName;
        $newLocation->slug = Str::slug($request->locationName, '-');

        $result = $newLocation->save();

        if ($result) {
            return Redirect::route('location.index')->with('success', 'Location created successfully.');
        }
    }
}
