@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2>Admin Dashboard</h2>

<p>Welcome, {{ auth('admin')->user()->name }}!</p>

<ul>
    <li><a href="{{ route('admin.products.index') }}">Manage Products</a></li>
    <li><a href="{{ route('admin.orders.index') }}">View Orders</a></li>
    <li><a href="{{ route('admin.products.import.form') }}">Bulk Import Products</a></li>
</ul>
@endsection
