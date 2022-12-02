@extends('posts.layout')


@section('title')
Post Create
@endsection

@section('content')

<div class="row">
    <div class="pull-left">
        <h2 class="layout-header">Laravel Post CRUD</h2>
    </div>
    <div class="d-grid">
        <a class="btn btn-primary" href="{{ route('posts.index') }}">Home</a>
    </div>
</div>

<div class="container">
    <div class="form">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <legend>Create Post</legend>
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="description" placeholder="Description" value="{{ old('description') }}">
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="status" placeholder="Status" value="{{ old('status') }}">
                @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection
