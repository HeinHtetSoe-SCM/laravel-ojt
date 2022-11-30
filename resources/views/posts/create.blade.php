@extends('posts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>Post Create</title>
</head>
<body>
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
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <legend>Create Post</legend>
                <input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
                <input type="text" name="description" placeholder="Description" value="{{ old('description') }}">
                <input type="text" name="status" placeholder="Status" value="{{ old('status') }}">
                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>
</body>
</html>
@endsection