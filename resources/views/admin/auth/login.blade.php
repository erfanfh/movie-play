@extends('admin.auth.auth')
@section('title', 'Admin Login')
@section('action')
    {{ route('login.post') }}
@endsection
@section('csrf')
    @csrf
@endsection
@section('link')
    {{ route('admin.register') }}
@endsection
@section('message', 'Don\'t have')
@section('topic', 'Admin Login')
@section('button', 'Login')
