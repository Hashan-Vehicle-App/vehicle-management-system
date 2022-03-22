@extends ('layouts.auth')

@section('title', 'Client Login')

@section('content')
<form method="post" action="/client/login" class="login-form">
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

  <div class="form-group mb-4">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" value="{{ old('password') }}"
      class="form-control @error('password') is-invalid @enderror">
    @error('password')
    <div class="error">{{ $message }}</div>
    @enderror
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" role="button" class="btn btn-accent">Login</button>
  </div>
</form>
@endsection