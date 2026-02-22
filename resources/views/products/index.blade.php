@extends('layouts.app')

@section('title', 'Products')

@section('content')

<h2>Add Product</h2>

<form method="POST" action="/products">
    @csrf
    <input type="text" name="name" placeholder="Product name">
    <input type="number" name="price" placeholder="Price">
    <button type="submit">Add</button>
</form>

<hr>

<h2>All Products</h2>

@foreach($products as $product)
    <div>
        <a href="/products/{{ $product->id }}">
            {{ $product->name }}
        </a>
        - {{ $product->price }}
    </div>
@endforeach

@endsection
