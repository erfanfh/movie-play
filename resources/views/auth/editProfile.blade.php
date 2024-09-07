@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column justify-content-center px-5 gap-3">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}">
                @error('username')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text">You can change your username whenever you want.</div>
            </div>
            <button type="submit" class="btn btn-primary">Change username</button>
        </form>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input type="password" class="form-control" name="old_password">
                @error('old_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @if (session('message'))
                <div class="alert alert-danger">{{ $message }}</div>
            @endif
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text text-danger">You'll be logged out if you change your password</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm new Password</label>
                <input type="password" class="form-control" name="password_confirmation">
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Change password</button>
        </form>
    </div>
@endsection
