@extends('layouts.app')

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
</form>

<div class="form-group mb-4">
    <label for="vehicleCategory">Select one from Available Vehicles</label>

    <!-- populate vehicle categories -->
    <select name="vehicleCategory" id="vehicleCategory" class="form-control">
        @foreach ( $vehicleCategories as $category )

        <option value="{{ $category->id }}">{{ $category->title }}</option>

        @endforeach
    </select>
</div>

@endsection