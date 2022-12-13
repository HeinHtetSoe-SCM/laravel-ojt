@extends('layouts.app')

@section('title')
Post Edit
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('posts.update', ['id' => $data['post']->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <legend>Edit Post</legend>
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="file" id="image" style="display: none;">
                <div style="height: 100px; width: 150px;">
                    <label for="image" style="display: block; height: 100px; width: 150px;">
                        @if($data['post']->image === null)
                        <img id="preview-image" src="/assets/default.png" alt="default image" class="img-thumbnail" />
                        @else
                        <img id="preview-image" src="/images/{{ $data['post']->image }}" alt="{{ $data['post']->image }}" class="img-thumbnail" />
                        @endif
                    </label>
                </div>
                @error('file')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="{{ old('title', $data['post']->title) }}">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" id="description" class="form-control" name="description" placeholder="Description" value="{{ old('description', $data['post']->description) }}">
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status">Status</label>
                <input type="text" id="status" class="form-control" name="status" placeholder="Status" value="{{ old('status', $data['post']->status) }}">
                @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select id="category" class="form-select" name="categories[]" multiple>
                    @foreach ($data['categories'] as $category)
                    <option value="{{ $category->id }}" @if (in_array($category->id, old('categories', $data['oldCategoryIds'])))
                        selected
                        @endif
                        >
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('categories')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection