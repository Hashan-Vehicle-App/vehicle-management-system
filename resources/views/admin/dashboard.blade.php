@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<p>This is admin dashboard</p>

<form action="{{ route('adminLogout') }}" method="post">
  @csrf
  <button type="submit">Logout</button>
</form>
@endsection