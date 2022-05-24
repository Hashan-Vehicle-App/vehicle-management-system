<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class VehicleRequestController extends Controller
{

    public function index()
    {
        $vehicleRequests = VehicleRequest::with('vehicle.category', 'pickupLocation', 'deliverLocation')->orderBy('status')->orderBy('pickup_date', 'desc')->get();
        return $vehicleRequests;
    }

    public function listByStatus($status)
    {
        return VehicleRequest::with('vehicle.category', 'pickupLocation', 'deliverLocation')->where('status', $status)->orderBy('pickup_date')->get();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'vehicle' => 'required',
            'pickupLocation' => 'required',
            'deliverLocation' => 'required',
            'pickupDate' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Create new vehicle
        $newRequest = new VehicleRequest();

        $newRequest->vehicle_id = $request->vehicle;
        $newRequest->pickup_location_id = $request->pickupLocation;
        $newRequest->deliver_location_id = $request->deliverLocation;
        $newRequest->pickup_date = $request->pickupDate;

        $result = $newRequest->save();

        if ($result) {
            //return Redirect::back()->with('success', 'Vehicle successfully created.');
            return Redirect::back()->with('success', 'Vehicle request submitted.');
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $vehicleRequest = VehicleRequest::find($id);
        $vehicleRequest->status = $request->status;

        $result = $vehicleRequest->save();

        if ($result) {
            return Redirect::back()->with('success', 'Vehicle request updated.');
        }
    }
}
