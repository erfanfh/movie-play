@extends('auth.auth')
@section('title', 'Login')
@section('action')
    {{ route('login.post') }}
@endsection
@section('csrf')
    @csrf
@endsection
@section('link')
    {{ route('register') }}
@endsection
@section('message', 'Don\'t have')
@section('button', 'Login')
