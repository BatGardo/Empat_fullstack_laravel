<!-- filepath: resources/views/tags/index.blade.php -->
@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tags</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Add tag</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Products</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td><span class="badge bg-info">{{ $tag->products_count }}</span></td>
                    <td>
                        <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{{ $tags->links('pagination::bootstrap-5') }}
@endsection
