@extends('layouts.clientApp')

@section('title', 'Dashboard')

@section('content')

<h2>Request a Vehicle</h2>

<form action="" method="POST">
    @csrf

    <!-- Show success message -->
    @if (session('success'))

    <div class="mb-4">
        <div class="success">{{ session('success') }}</div>
    </div>

    @endif


    <div class="form-group mb-4">
        <label for="vehicleCategory">Select one from Available Vehicles</label>

        <!-- select vehicle category -->
        <select name="vehicleCategory" id="vehicleCategory" class="form-control">
            @foreach ( $vehicleCategories as $category )

            <option value="{{ $category->id }}">{{ $category->title }}</option>

            @endforeach
        </select>
    </div>

    <!-- select pickup location -->
    <div class="form-group mb-4">
        <label for="pickupLocation">Pickup Location</label>

        <select name="pickupLocation" id="pickupLocation" class="form-control">
            <option value="-1" disabled selected>Select a pickup location</option>

            @foreach ( $locations as $location )

            <option value="{{ $location->id }}">{{ $location->location_name }}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group mb-4">
        <div class="input-group date">
            <input type="text" class="form-control" value="12-02-2012">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>

    <!-- select deliver location -->
    <div class="form-group mb-4">
        <label for="deliverLocation">Deliver Location</label>

        <select name="deliverLocation" id="deliverLocation" class="form-control">
            <option value="-1" disabled selected>Select a deliver location</option>

            @foreach ( $locations as $location )

            <option value="{{ $location->id }}">{{ $location->location_name }}</option>

            @endforeach
        </select>
    </div>
</form>
@endsection