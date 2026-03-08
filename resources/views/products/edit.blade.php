@extends('layouts.appMain')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                required
            >
        </div>

        <div>
            <label>Price</label>
            <input
                type="number"
                name="price"
                step="0.01"
                value="{{ old('price', $product->price) }}"
                required
            >
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label>Category</label>
            <select name="category_id" required>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Tags</label>

            @foreach($tags as $tag)
                <div>
                    <label>
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                        >
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach

        </div>

        <button type="submit">Update Product</button>
    </form>
</div>
@endsection
