@extends('posts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    @vite(['resources/js/app.js'])
    <title>Post List</title>
</head>
<body>
    <div class="row">
        <div class="pull-left">
            <h2 class="layout-header">Laravel Post CRUD</h2>
        </div>
        <div class="d-grid">
            <a class="btn btn-primary" href="{{ route('posts.create') }}">Create</a>
        </div>
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
</body>
</html>
@endsection

