@extends('admin.layouts.admin')

@section('title', 'View Product')

@section('content')
<h2>Product Details</h2>

<div class="card mb-3" style="max-width: 600px;">
  <div class="row g-0">
    <div class="col-md-4">
      @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="product">
      @else
        <img src="{{ asset('images/default-product.png') }}" class="img-fluid rounded-start" alt="default">
      @endif
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description ?? 'No description' }}</p>
        <p class="card-text"><strong>Price:</strong> ₹{{ $product->price }}</p>
        <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
        <p class="card-text"><strong>Category:</strong> {{ $product->category?->name ?? '-' }}</p>
        <p class="card-text"><small class="text-muted">Added {{ $product->created_at->format('d M Y') }}</small></p>
      </div>
    </div>
  </div>
</div>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to list</a>
<a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
  @csrf @method('DELETE')
  <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
