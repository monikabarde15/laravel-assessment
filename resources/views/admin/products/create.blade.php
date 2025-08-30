@extends('admin.layouts.admin')

@section('title', 'Add Product')

@section('content')
<h2>Add Product</h2>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control"></textarea>
  </div>
  <div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <option value="">-- None --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <button class="btn btn-success">Save</button>
</form>
@endsection
