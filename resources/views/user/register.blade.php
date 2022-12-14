@extends('layouts.app')


@section('title')
User Register
@endsection

@section('content')

<div class="container">
    <div class="form">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <legend>Registeration</legend>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password" value="{{ old('password_confirm') }}">
                @error('password_confirm')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>

@endsection