@extends ('layouts.app')

@section('title', 'Vehicle Categories')

@section('content')

<form action="{{ route('manageVehicleCategories') }}" method="POST" style="max-width: 400px">
  @csrf

  <!-- Show success message -->
  @if (session('success'))

    <div class="mb-4">
      <div class="success">{{ session('success') }}</div>
    </div>

  @endif

  <div class="mb-3">
    <div class="flex">
      <div class="flex-1 w-full">
        <input id="vehicleCategoryName" name="vehicleCategoryName" type="text" value="{{ old('vehicleCategoryName') }}" placeholder="Vehicle Category"
      class="form-control @error('vehicleCategoryName') is-invalid @enderror">
      </div>

      <div class="ml-3">
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
<div class="mt-10">

  @if($vehicleCategories)

    <table class="w-full">

      @foreach ($vehicleCategories as $category)

        <tr class="border-b border-zinc-400">
          <td class="py-3">{{ $category->title }}</td>
        </tr>

      @endforeach

    </table>

  @else

    <p>No categories</p>

  @endif

</div>

@endsection