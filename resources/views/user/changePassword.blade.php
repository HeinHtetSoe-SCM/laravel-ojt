@extends('layouts.app')


@section('title')
User Login
@endsection

@section('content')

<div class="container">
    @if ($message = Session::get('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="form">
        <form action="{{ route('user.changePassword') }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <legend>Change Password</legend>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="New Password" value="{{ old('password') }}">
                @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm New Password" value="{{ old('password_confirm') }}">
                @error('password_confirm')
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