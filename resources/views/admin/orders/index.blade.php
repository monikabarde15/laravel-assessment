@extends('admin.layouts.admin')

@section('title', 'Orders')

@section('content')
<h2>Orders List</h2>

@if($orders->isEmpty())
    <p>No orders yet.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name->name ?? 'N/A' }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                        @csrf
                        @method('PATCH')
                      <select name="status" required>
                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>

                        <button class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@endsection
