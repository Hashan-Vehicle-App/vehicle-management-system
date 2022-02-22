@extends ('layouts.app')

@section('title', 'Add Vehicle')

@section('content')

<form action="" method="POST" style="max-width: 400px">
  @csrf

  @error ('message')
  <div class="mb-4 text-center">
    <div class="error d-block">{{ $message }}</div>
  </div>
  @enderror

  <div class="form-group mb-3">
    <label for="vehicleNo">Vehicle No</label>

    <input id="vehicleNo" name="vehicleNo" type="text" value="{{ old('vehicleNo') }}"
      class="form-control @error('vehicleNo') is-invalid @enderror">

    @error('vehicleNo')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <label for="vehicleName">Vehicle Name</label>

    <input id="vehicleName" name="vehicleName" type="text" value="{{ old('vehicleName') }}"
      class="form-control @error('vehicleName') is-invalid @enderror">

    @error('vehicleName')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group mb-3">
    <label for="vehicleCategory" class="block">Vehicle Category</label>

    <select name="vehicleCategory" id="vehicleCategory" class="form-control">
      <option value=" 1">Category 1</option>
      <option value="1">Category 2</option>
      <option value="1">Category 3</option>
    </select>

    @error('vehicleCategory')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="mt-6">
    <button type="submit" role="button" class="btn btn-primary">Add Vehicle</button>
  </div>
</form>

@endsection