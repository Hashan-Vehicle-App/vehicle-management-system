@extends ('layouts.app')

@section('title', 'Vehicle Categories')

@section('content')

<form action="{{ route('createVehicleCategory') }}" method="POST" style="max-width: 400px" class="mb-5">
  @csrf

  <!-- Show success message -->
  @if (session('success'))

  <div class="mb-4">
    <div class="success">{{ session('success') }}</div>
  </div>

  @endif

  <div class="mb-3">
    <div class="d-flex">
      <div class="w-100" style="flex: 1">
        <input id="vehicleCategoryName" name="vehicleCategoryName" type="text" value="{{ old('vehicleCategoryName') }}" placeholder="Vehicle Category" class="form-control @error('vehicleCategoryName') is-invalid @enderror">
      </div>

      <div class="ms-3">
        <button type="submit" role="button" class="btn btn-primary">Add Category</button>
      </div>
    </div>

    <!-- Show error message -->
    @error('vehicleCategoryName')
    <div class="error mt-4">{{ $message }}</div>
    @enderror
  </div>

</form>

<!-- Display categories -->
<div>

  @if($vehicleCategories)

  <table class="w-100 table table-bordered">

    <thead>
      <tr>
        <th>Category</th>
        <th>No. of Vehicles</th>
        <th></th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      @foreach ($vehicleCategories as $category)

      <tr>
        <td>{{ $category->title }}</td>
        <td>1</td>
        <td class="text-center">
          <!-- Edit vehicle link -->
          <a href="{{ route('showEditVehicleCategory', ['id' => $category->id]) }}" class="text-accent cursor-pointer"><i class="fa-solid fa-pen-to-square"></i></a>
        </td>
        <td class="text-center">
          <span class="text-danger cursor-pointer"><i class="fa-solid fa-trash-can"></i></span>
        </td>
      </tr>

      @endforeach
    </tbody>

  </table>

  @else

  <p>No categories</p>

  @endif

</div>

@endsection