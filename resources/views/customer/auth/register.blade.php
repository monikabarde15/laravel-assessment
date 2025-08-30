@extends('customer.layouts.customer')

@section('title', 'Register')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Register</h2>

    <form method="POST" action="{{ route('customer.register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Register</button>
        <a href="{{ route('customer.login') }}" class="btn btn-link">Login</a>
    </form>
</div>
@endsection
