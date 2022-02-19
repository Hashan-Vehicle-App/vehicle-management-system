@extends ('layouts.external')

@section('title', 'Login')

@section('content')
    <form method="post" action="/admin/login" class="login-form mx-auto rounded-sm bg-white p-6 mt-10">
        @csrf

        <h2 class="mb-3 text-center">Admin Login</h2>

        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror">
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-center">
            <button type="submit" role="button" class="btn btn-primary">Login</button>
        </div>

        @error ('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
@endsection