@extends('layouts.app')


@section('title')
Post Create
@endsection

@section('content')

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
            <div class="mb-3">
                <select class="form-select" name="categories[]" multiple>
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