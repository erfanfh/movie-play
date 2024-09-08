@extends('admin.dashboard.master')

@section('content')
    <div class="h2">User information</div>
    <hr>
    <form action="{{ route('dashboard.users.update', $user) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label for="formFile" class="form-label">Username</label>
            <input class="form-control" name="username" type="text" value="{{ $user->username }}">
        </div>
        @error('username')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3"
                onclick="return confirm('Are you sure you want to change the user username?')">Edit
        </button>
    </form>
    <form action="{{ route('dashboard.users.destroy', $user) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete the user?')">Delete User
        </button>
    </form>
    <form action="{{ route('dashboard.users.password.update', $user) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label class="form-label">New Password</label>
            <input type="text" name="password" class="form-control">
        </div>
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-3">
            <label class="form-label">Confirm new Password</label>
            <input type="text" name="password_confirmation" class="form-control">
        </div>
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3"
                onclick="return confirm('Are you sure you want to change the user password?')">Change password
        </button>
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
        @endif
    </form>
@endsection
