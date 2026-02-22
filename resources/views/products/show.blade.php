@extends('layouts.app')

@section('title', 'Product')

@section('content')

<h2>{{ $product->name }}</h2>
<p>Price: {{ $product->price }}</p>

<a href="/products">Back</a>

@endsection
