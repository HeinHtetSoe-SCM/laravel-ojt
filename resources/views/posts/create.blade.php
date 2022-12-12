@extends('layouts.app')


@section('title')
Post Create
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <legend>Create Post</legend>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="file" id="image">
                @error('file')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" id="title" value="{{ old('title') }}">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description" id="description" value="{{ old('description') }}">
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status">Status</label>
                <input type="text" class="form-control" name="status" placeholder="Status" id="status" value="{{ old('status') }}">
                @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select class="form-select" name="categories[]" id="category" multiple>
                    @foreach ( $categories as $index => $category )
                    <option value="{{ $category->id }}" {{ ($index === 0) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection