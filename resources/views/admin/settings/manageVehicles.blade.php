@extends ('layouts.app')

@section('title', 'Manage Vehicles')

@section('content')

<form action="{{ route('createVehicle') }}" method="POST" style="max-width: 400px">
  @csrf

  <!-- Show success message -->
  @if (session('success'))

    <div class="mb-4">
      <div class="success">{{ session('success') }}</div>
    </div>

  @endif

  <div class="form-group mb-3">
    <label for="vehicleNo">Vehicle No</label>

    <input id="vehicleNo" name="vehicleNo" type="text" value="{{ old('vehicleNo') }}"
      class="form-control @error('vehicleNo') is-invalid @enderror">

    @error('vehicleNo')
      <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <label for="vehicleCategory" class="block">Category</label>

    <!-- Populate vehicle categories -->
    <select name="vehicleCategory" id="vehicleCategory" class="form-control">

      @foreach ( $vehicleCategories as $category)

        <option value="{{ $category->id }}">{{ $category->title }}</option>
        
      @endforeach

    </select>

    @error('vehicleCategory')
      <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="mt-6">
    <button type="submit" role="button" class="btn btn-primary">Add Vehicle</button>
  </div>
</form>

<!-- Display vehicles -->
<div class="mt-10">

  <h3 class="underline">Vehicles</h3>

  @if($vehicles)

    <table class="w-full">

      <tr>
        <th class="text-left">Vehicle No</th>
        <th class="text-left">Category</th>
        <th class="text-left">Status</th>
      </tr>

      @foreach ($vehicles as $vehicle)

        <tr class="border-b border-zinc-400">
          <td class="py-3">{{ $vehicle->vehicle_no }}</td>
          <td class="py-3">{{ $vehicle->category->title }}</td>
          <td class="py-3">{{ $vehicle->status }}</td>
        </tr>

      @endforeach

    </table>

  @else

    <p>No vehicles.</p>

  @endif

</div>

@endsection