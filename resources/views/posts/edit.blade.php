@extends('posts.layout')

@section('content')
    <div class="row">
        <div class="pull-left">
            <h2 class="layout-header">Laravel Post CRUD</h2>
        </div>
        <div class="pull-right">
            <a class="btn" href="{{ route('posts.index') }}">Home</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="error-container">
            There are some problems with your input. <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="form">
            <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <legend>Edit Post</legend>
                <input type="text" name="title" placeholder="Title" value="{{ $post->title }}">
                <input type="text" name="description" placeholder="Description" value="{{ $post->description }}">
                <input type="text" name="status" placeholder="Status" value="{{ $post->status }}">
                <button type="submit" class="btn">Save</button>
            </form>
        </div>
    </div>
@endsection