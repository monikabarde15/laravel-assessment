@extends('admin.layouts.admin')

@section('title', 'Edit Product')

@section('content')
<h2>Edit Product</h2>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
  </div>
  <div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <option value="">-- None --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Image</label>
    @if($product->image)
      <p><img src="{{ asset('storage/'.$product->image) }}" alt="img" width="80"></p>
    @endif
    <input type="file" name="image" class="form-control">
  </div>
  <button class="btn btn-primary">Update</button>
</form>
@endsection
