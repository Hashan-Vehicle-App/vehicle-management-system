@extends ('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')

<form action="{{ route('updateVehicle', ['id' => $vehicle->id]) }}" method="POST" style="max-width: 400px" class="mb-5">
    @csrf
    @method('PUT')

    <!-- Show success message -->
    @if (session('success'))

    <div class="mb-4">
        <div class="success">{{ session('success') }}</div>
    </div>

    @endif

    <div class="form-group mb-3">
        <label for="vehicleNo">Vehicle No</label>

        <input id="vehicleNo" name="vehicleNo" type="text" value="{{ old('vehicleNo', $vehicle->vehicle_no) }}" class="form-control @error('vehicleNo') is-invalid @enderror">

        @error('vehicleNo')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="vehicleCategory">Category</label>

        <!-- Populate vehicle categories -->
        <select name="vehicleCategory" id="vehicleCategory" class="form-control">

            @foreach ( $vehicleCategories as $category)

            <option value="{{ $category->id }}" {{ old("vehicleCategory", $vehicle->category_id) == $category->id ? "selected" : '' }}>{{ $category->title }}</option>

            @endforeach

        </select>

        @error('vehicleCategory')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit" role="button" class="btn btn-primary">Edit Vehicle</button>
    </div>
</form>

@endsection