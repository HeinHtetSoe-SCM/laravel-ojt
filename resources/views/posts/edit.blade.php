@extends('layouts.app')

@section('title')
Post Edit
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('posts.update', ['id' => $data['post']->id]) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <legend>Edit Post</legend>
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title', $data['post']->title) }}">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="description" placeholder="Description" value="{{ old('description', $data['post']->description) }}">
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="status" placeholder="Status" value="{{ old('status', $data['post']->status) }}">
                @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-select" name="categories[]" multiple>
                    @foreach ($data['categories'] as $category)
                    <option 
                        value="{{ $category->id }}" 
                        @if (in_array($category->id, old('categories', $data['oldCategoryIds'])))
                            selected
                        @endif
                        >
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
