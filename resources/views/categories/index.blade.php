@extends('layouts.app')

@section('title')
Category List
@endsection

@section('content')
<div class="container">
    <div class="d-grid gap-2">
        <a class="btn btn-primary" href="{{ route('categories.create') }}">Create</a>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table table-hover table-bordered border-primary">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </thead>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category['name'] }}</td>
            <td>{{ $category['created_at'] }}</td>
            <td>{{ $category['updated_at'] }}</td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-grid gap-2 col-6 mx-auto">
    {{ $categories->links() }}
    </div>
</div>
@endsection