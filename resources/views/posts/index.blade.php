@extends('layouts.app')

@section('title')
Post List
@endsection

@section('content')

<div class="d-grid gap-2">
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create</a>
</div>

<div class="d-grid gap-2">
    <form action="{{ route('posts.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        @error('file')
        <div class="form-text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <button class="btn btn-success">Import Posts</button>
        <a href="{{ route('posts.export') }}" id="export" class="btn btn-info">Export Posts</a>
    </form>
</div>

@if ($message = Session::get('message'))
<div class="alert {{ $message == "Posts imported successfully" ? 'alert-info' : 'alert-danger' }} alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<table class="table table-hover table-bordered border-primary">
    <thead>
        <th>ID</th>
        <th>Image</th>
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
        <td style="height: 150px; width: 150px;">
            @if($post->image === null)
            <img src="/assets/default.png" alt="default image" class="img-thumbnail"/>
            @else
            <img src="/images/{{ $post->image }}" alt="{{ $post->image }}" class="img-thumbnail"/>
            @endif
        </td>
        <td>{{ $post['title'] }}</td>
        <td>{{ $post['description'] }}</td>
        <td>{{ $post['status'] }}</td>
        <td>
            @foreach ($post->categories as $category)
            {{ $category->name }}
            @endforeach
        </td>
        <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($post['updated_at'])->format('d/m/Y') }}</td>
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