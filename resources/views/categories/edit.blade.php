@extends('layouts.app')

@section('title')
Category Edit
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <legend>Edit Category</legend>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $category->name) }}">
                @error('name')
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
