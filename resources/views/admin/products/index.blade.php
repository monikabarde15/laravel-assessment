@extends('admin.layouts.admin')

@section('title', 'Products')

@section('content')
<h2>Products</h2>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Image</th><th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->name }}</td>
      <td>{{ $p->category?->name ?? '-' }}</td>
      <td>₹{{ $p->price }}</td>
      <td>{{ $p->stock }}</td>
      <td>
        @if($p->image)
          <img src="{{ asset('storage/'.$p->image) }}" alt="img" width="60">
        @else
          <span>No image</span>
        @endif
      </td>
      <td>
        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline;">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $products->links() }}
@endsection
