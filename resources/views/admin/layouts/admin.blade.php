<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @yield('title', config('app.name'))</title>

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap (quick) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ config('app.name', 'App') }} (Admin)</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.import.form') }}">Import</a>
</li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth('admin')
          <li class="nav-item"><span class="nav-link">Hi, {{ auth('admin')->user()->name }}</span></li>
          <li class="nav-item">
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-outline-light">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Login</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <!-- Flash / Validation -->
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

  <!-- Main content -->
  <div class="card">
    <div class="card-body">
      @yield('content')
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
