<!-- filepath: resources/views/categories/show.blade.php -->
@extends('layouts.appMain')

@section('title', $category->name)

@section('content')
    <div class="mb-4">
        <h1>{{ $category->name }}</h1>
        <p class="text-muted">{{ $category->description }}</p>
    </div>

    <div class="mb-4">
        <h3>Products in this category ({{ $category->products()->count() }})</h3>
        <div class="row">
            @forelse ($category->products as $product)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p><strong>Price:</strong> {{ $product->price }} UAH</p>
                            <p><strong>Tags:</strong>
                                @foreach ($product->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                            <p><strong>Reviews:</strong> {{ $product->reviews()->count() }}</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No products in this category</p>
            @endforelse
        </div>
    </div>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
@endsection
