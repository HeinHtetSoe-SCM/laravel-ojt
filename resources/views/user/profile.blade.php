@extends('layouts.app')


@section('title')
User Login
@endsection

@section('content')

<div class="container">
    <div class="card mx-auto mt-5 border-primary text-center" style="max-width: 18rem;">
        <div class="card-header">Profile</div>
        <div class="card-body">
            <h5 class="card-title">Name: {{ $userData->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Email: {{ $userData->email }}</h6>
            <a href="{{ route('user.edit') }}" class="btn btn-primary">Update Profile</a>
            <a href="{{ route('user.changePasswordPage') }}" class="btn btn-outline-warning mt-2">Change Password</a>
        </div>
    </div>
</div>

@endsection