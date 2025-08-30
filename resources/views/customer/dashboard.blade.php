@extends('customer.layouts.customer')

@section('title', 'Dashboard')

@section('content')
<h2>customer Dashboard</h2>
<h3>Notifications</h3>
<ul>
@foreach(auth('customer')->user()->notifications as $notification)
    <li>
        {{ $notification->data['message'] }} 
        - {{ $notification->created_at->diffForHumans() }}
    </li>
@endforeach
</ul>
<p>Welcome, {{ auth('customer')->check() ? auth('customer')->user()->name : 'Guest' }}!</p>


@endsection
