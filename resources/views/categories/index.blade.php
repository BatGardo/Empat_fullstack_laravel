<!-- filepath: resources/views/categories/index.blade.php -->
@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Category</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add category</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Products</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td><span class="badge bg-info">{{ $category->products_count ?? $category->products()->count() }}</span></td>
                    <td>
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{ $categories->links('pagination::bootstrap-5') }}
@endsection
