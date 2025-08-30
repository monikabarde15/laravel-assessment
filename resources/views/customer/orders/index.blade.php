@extends('customer.layouts.customer')

@section('title', 'My Orders')

@section('content')
<h2>My Orders</h2>

@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Status</th>
      <th>Total</th>
      <th>Items</th>
      <th>Placed On</th>
    </tr>
  </thead>
  <tbody>
    @forelse($orders as $order)
      <tr>
        <td>#{{ $order->id }}</td>
        <td>
          <span class="badge bg-{{ $order->status == 'Delivered' ? 'success' : ($order->status == 'Shipped' ? 'info' : 'secondary') }}">
            {{ $order->status }}
          </span>
        </td>
        <td>₹{{ $order->total }}</td>
        <td>
          <ul class="mb-0">
            @foreach($order->items as $item)
              <li>{{ $item->product->name }} (x{{ $item->qty }})</li>
            @endforeach
          </ul>
        </td>
        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
      </tr>
    @empty
      <tr><td colspan="5">No orders found.</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
