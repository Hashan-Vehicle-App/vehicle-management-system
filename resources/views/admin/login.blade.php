@extends ('layouts.auth')

@section('title', 'Admin Login')

@section('content')
<form method="post" action="/admin/login" class="login-form">
  @csrf


  @error ('message')
  <div class="mb-4 text-center">
    <div class="error d-block">{{ $message }}</div>
  </div>
  @enderror


  <div class="form-group mb-3">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" value="{{ old('username') }}"
      class="form-control @error('username') is-invalid @enderror">
    @error('username')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group mb-8">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" value="{{ old('password') }}"
      class="form-control @error('password') is-invalid @enderror">
    @error('password')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="flex justify-center">
    <button type="submit" role="button" class="btn btn-accent">Login</button>
  </div>
</form>
@endsection