@extends ('layouts.external')

@section('title', 'Login')

@section('content')
    <form method="post" action="/login" class="login-form mx-auto rounded-sm bg-white p-6 mt-10">
        @csrf

        <h2 class="mb-3 text-center">Admin Login</h2>

        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror">
        </div>

        <div class="form-group mb-4">
            <label for="password">Password</label>
            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror">
        </div>

        <div class="flex justify-center">
            <button type="submit" role="button" class="btn btn-primary">Login</button>
        </div>
    </form>
@endsection