@extends('layouts.app')


@section('title')
Category Create
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <legend>Create category</legend>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
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
