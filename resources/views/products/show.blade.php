<!-- filepath: resources/views/products/show.blade.php -->
@extends('layouts.appMain')

@section('title', $product->name)

@section('content')
    <div class="mb-4">
        <h1>{{ $product->name }}</h1>
        <p class="text-muted">{{ $product->description }}</p>
        <p><strong>Price:</strong> <span class="h3">{{ $product->price }} UAH</span></p>
        <p><strong>Category:</strong>
            <a href="{{ route('categories.show', $product->category) }}">
                {{ $product->category->name }}
            </a>
        </p>
    </div>

    <div class="mb-4">
        <h3>Tags</h3>
        @forelse ($product->tags as $tag)
            <span class="badge bg-secondary">{{ $tag->name }}</span>
        @empty
            <p class="text-muted">No tags</p>
        @endforelse
    </div>

    <div class="mb-4">
        <h3>Reviews ({{ $product->reviews()->count() }})</h3>
        @forelse ($product->reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Rating:</strong>
                        @for ($i = 0; $i < $review->rating; $i++)
                            ⭐
                        @endfor
                    </p>
                    <p>{{ $review->content }}</p>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted">No reviews</p>
        @endforelse
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
@endsection
