@extends('customer.layouts.customer')

@section('title', 'Shop')

@section('content')
<h2>Shop Products</h2>

<form method="GET" class="mb-3">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="form-control w-50 d-inline">
    <button type="submit" class="btn btn-secondary">Search</button>
</form>

<div class="row">
@foreach($products as $p)
  <div class="col-md-4 mb-3">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">{{ $p->name }}</h5>
        <p class="card-text">{{ $p->description ?? '-' }}</p>
        <p><strong>Price:</strong> ₹{{ $p->price }}</p>
        <form action="{{ route('customer.orders.store') }}" method="POST">
          @csrf
          <input type="hidden" name="items[0][product_id]" value="{{ $p->id }}">
          <input type="number" name="items[0][qty]" value="1" min="1" class="form-control w-50 mb-2">
          <button type="submit" class="btn btn-success btn-sm">Order</button>
        </form>
      </div>
    </div>
  </div>
@endforeach
</div>

<div class="mt-3">
  {{ $products->links() }}
</div>
@endsection
