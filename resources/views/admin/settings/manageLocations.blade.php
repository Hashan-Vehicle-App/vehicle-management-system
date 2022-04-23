@extends ('layouts.app')

@section('title', 'Manage Locations')

@section('content')

<form action="{{ route('createLocation') }}" method="POST" style="max-width: 400px" class="mb-5">
    @csrf

    <!-- Show success message -->
    @if (session('success'))

    <div class="mb-4">
        <div class="success">{{ session('success') }}</div>
    </div>

    @endif

    <!-- Show deleted message -->
    @if (session('delete'))

    <div class="mb-4">
        <div class="error">{{ session('delete') }}</div>
    </div>

    @endif

    <div class="mb-3">
        <div class="d-flex">
            <div class="w-100" style="flex: 1">
                <input id="locationName" name="locationName" type="text" value="{{ old('locationName') }}" placeholder="Location" class="form-control @error('locationName') is-invalid @enderror">
            </div>

            <div class="ms-3">
                <button type="submit" role="button" class="btn btn-primary">Add Location</button>
            </div>
        </div>

        <!-- Show error message -->
        @error('locationName')
        <div class="error mt-4">{{ $message }}</div>
        @enderror
    </div>

</form>

<!-- Display locations -->
<div class="rounded shadow-sm" style="overflow: hidden;">

    <div class="px-3 pt-3 pb-2" style="background-color: #f5f5f5">
        <h5 class="mb-0">Locations</h5>
    </div>

    <div class="bg-white p-4">
        @if($locations)

        <table class="w-100 table table-bordered mb-0">

            <thead>
                <tr>
                    <th>Location Name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($locations as $location)

                <tr>
                    <td>{{ $location->location_name }}</td>
                    <td class="text-center">
                    </td>
                    <td class="text-center">
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>

        @else

        <p>No locations</p>

        @endif
    </div>

    @endsection