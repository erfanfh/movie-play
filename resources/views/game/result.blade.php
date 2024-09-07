@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
        <div class="h2">Score: {{ $score }}</div>
        <div class="h1">{{ $message }}</div>
        <a href="{{ route('home') }}" class="btn btn-primary">Back to home</a>
    </div>
@endsection
