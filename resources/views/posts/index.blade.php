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
        <div class="pull-right">
            <a class="btn" href="{{ route('posts.create') }}">Create</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="message">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table>
        <caption>Post List</caption>
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
                    <a class="btn" href="{{ route('posts.edit', ['id' =>$post->id]) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
@endsection
