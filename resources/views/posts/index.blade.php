@extends('layouts.app')

@section('title')
Post List
@endsection

@section('content')

<div class="d-grid gap-2">
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create</a>
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
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Category</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Actions</th>
    </thead>
    @foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post['title'] }}</td>
        <td>{{ $post['description'] }}</td>
        <td>{{ $post['status'] }}</td>
        <td>
            @foreach ($post->categories as $category)
            {{ $category->name }}
            @endforeach
        </td>
        <td>{{ $post['created_at'] }}</td>
        <td>{{ $post['updated_at'] }}</td>
        <td>
            <form action="{{ route('posts.delete', ['id' =>$post->id]) }}" method="post">
                <a class="btn btn-primary" href="{{ route('posts.edit', ['id' =>$post->id]) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-grid gap-2 col-6 mx-auto">
    {{ $posts->links() }}
</div>

@endsection


