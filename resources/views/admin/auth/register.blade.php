@extends('admin.auth.auth')
@section('title', 'Admin Register')
@section('action')
    {{ route('admin.register.post') }}
@endsection
@section('csrf')
    @csrf
@endsection
@section('key')
    <div class="mb-3">
        <label class="form-label text-black">Key</label>
        <input name="key" type="text" class="form-control">
        @error('key')
        <div class="text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
@endsection
@section('link')
    {{ route('admin.login') }}
@endsection
@section('message', 'Have')
@section('topic', 'Admin Register')
@section('button', 'Register')
