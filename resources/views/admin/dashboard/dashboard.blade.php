@extends('admin.dashboard.master')

@section('content')
    <h2>Dashboard</h2>
    <hr>
    <div class="text-secondary">Welcome, {{ auth()->user()->username }}. This is admin dashboard</div>
@endsection
