<!-- filepath: resources/views/products/index.blade.php -->
@extends('layouts.appMain')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add product</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Reviews</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} UAH</td>
                    <td>
                        <a href="{{ route('categories.show', $product->category) }}">
                            {{ $product->category->name }}
                        </a>
                    </td>
                    <td>
                        @foreach ($product->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td><span class="badge bg-info">{{ $product->reviews()->count() }}</span></td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{ $products->links('pagination::bootstrap-5') }}
@endsection
