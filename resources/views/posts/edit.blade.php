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
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $data['post']->title }}">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $data['post']->description }}">
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="status" placeholder="Status" value="{{ $data['post']->status }}">
                @error('status')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-select" name="category[]" multiple>
                    @foreach ( $data['categories'] as $category )
                        @if ($loop->index === 0)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
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
