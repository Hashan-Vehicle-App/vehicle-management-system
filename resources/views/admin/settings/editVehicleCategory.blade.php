@extends ('layouts.app')

@section('title', 'Edit Vehicle Category')

@section('content')

<form action="{{ route('updateVehicleCategory', ['id' => $vehicleCategory->id]) }}" method="POST" style="max-width: 400px" class="mb-5">
    @csrf
    @method('PUT')

    <!-- Show success message -->
    @if (session('success'))

    <div class="mb-4">
        <div class="success">{{ session('success') }}</div>
    </div>

    @endif

    <div class="mb-3">
        <div class="d-flex">
            <div class="w-100" style="flex: 1">
                <input id="vehicleCategoryName" name="vehicleCategoryName" type="text" value="{{ old('vehicleCategoryName', $vehicleCategory->title) }}" placeholder="Vehicle Category" class="form-control @error('vehicleCategoryName') is-invalid @enderror">
            </div>

            <div class="ms-3">
                <button type="submit" role="button" class="btn btn-primary">Edit Category</button>
            </div>
        </div>

        <!-- Show error message -->
        @error('vehicleCategoryName')
        <div class="error mt-4">{{ $message }}</div>
        @enderror
    </div>

</form>

@endsection