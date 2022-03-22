@extends ('layouts.app')

@section('title', 'Manage Vehicles')

@section('content')

<form action="{{ route('createVehicle') }}" method="POST" style="max-width: 400px" class="mb-5">
  @csrf

  <!-- Show success message -->
  @if (session('success'))

  <div class="mb-4">
    <div class="success">{{ session('success') }}</div>
  </div>

  @endif

  <div class="form-group mb-3">
    <label for="vehicleNo">Vehicle No</label>

    <input id="vehicleNo" name="vehicleNo" type="text" value="{{ old('vehicleNo') }}" class="form-control @error('vehicleNo') is-invalid @enderror">

    @error('vehicleNo')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group mb-4">
    <label for="vehicleCategory">Category</label>

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

  <div>
    <button type="submit" role="button" class="btn btn-primary">Add Vehicle</button>
  </div>
</form>

<!-- Display vehicles -->
<div class="bg-white p-3 rounded shadow-sm">

  <h3>Vehicles</h3>

  @if($vehicles)

  <table class="table table-bordered">

    <tr>
      <th class="text-left">Vehicle No</th>
      <th class="text-left">Category</th>
      <th class="text-left">Status</th>
      <th></th>
      <th></th>
    </tr>

    @foreach ($vehicles as $vehicle)

    <tr class="border-b border-zinc-400">
      <td>{{ $vehicle->vehicle_no }}</td>
      <td>{{ $vehicle->category->title }}</td>
      <td>
        <div class="badge bg-primary">{{ $vehicle->status }}</div>
      </td>
      <td class="text-center">
        <!-- Edit vehicle link -->
        <a href="{{ route('showEditVehicle', ['id' => $vehicle->id]) }}" class="text-accent cursor-pointer"><i class="fa-solid fa-pen-to-square"></i></a>
      </td>
      <td class="text-center">
        <span class="text-danger cursor-pointer"><i class="fa-solid fa-trash-can"></i></span>
      </td>
    </tr>

    @endforeach

  </table>

  @else

  <p>No vehicles.</p>

  @endif

</div>

@endsection