@extends('admin.layouts.admin')

@section('title', 'Import Products')

@section('content')
<h2>Import Products from CSV</h2>

@if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Select File (CSV)</label>
        <input type="file" name="csv_file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload & Import</button>
</form>
@endsection
