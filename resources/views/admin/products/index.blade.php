@extends('admin.layouts.admin')

@section('title', 'Products')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
            <a href="{{ route('admin.products.import.form') }}" class="btn btn-success">Import CSV</a>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category?->name ?? '-' }}</td>
                <td>₹{{ number_format($p->price, 2) }}</td>
                <td>{{ $p->stock }}</td>
                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" alt="img" class="img-thumbnail" width="60">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
