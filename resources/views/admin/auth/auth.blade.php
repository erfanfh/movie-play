@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center p-5 mt-5">
            <h2 class="">@yield('topic')</h2>
            <form class="w-75" action="@yield('action')" method="post">
                @yield('csrf')
                <div class="mb-3">
                    <label class="form-label text-black">Username</label>
                    <input name="username" type="text" class="form-control">
                    @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @yield('key')
                <div class="mb-3">
                    <label class="form-label text-black">Password</label>
                    <input name="password" type="password" class="form-control">
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @if(session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                <p><a href="@yield('link')" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">@yield('message') an account?</a></p>
                <button type="submit" class="btn btn-secondary w-100">@yield('button')</button>
            </form>
        </div>
    </div>
@endsection
