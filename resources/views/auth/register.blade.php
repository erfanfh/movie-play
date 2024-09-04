@extends('auth.auth')
@section('title', 'Register')
@section('action')
    {{ route('register.post') }}
@endsection
@section('csrf')
    @csrf
@endsection
@section('link')
    {{ route('login') }}
@endsection
@section('message', 'Have')
@section('button', 'Register')
