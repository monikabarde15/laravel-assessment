@extends('customer.layouts.customer')

@section('title', 'Product')

@section('content')
<h2>{{ $product->name }}</h2>
<p>Price: {{ $product->price }}</p>
{{$product}}

<form action="{{ route('customer.orders.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
</form>
@endsection
