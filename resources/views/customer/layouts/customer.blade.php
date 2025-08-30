<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customer - @yield('title', config('app.name'))</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('customer.dashboard') }}">{{ config('app.name', 'App') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#custNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="custNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('customer.shop') }}">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('customer.orders.index') }}">My Orders</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth('customer')
          <li class="nav-item"><span class="nav-link">Hello, {{ auth('customer')->user()->name }}</span></li>
          <li class="nav-item">
            <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-outline-secondary">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('customer.login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('customer.register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
