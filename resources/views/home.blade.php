@extends('layouts.master')
@section('content')
    <img class="header-img" alt="" src="https://patterns.tkdemos.co/wp-content/uploads/2022/06/hed2.jpg">
    <div class="main-header w-100 d-flex flex-column justify-content-center align-items-center gap-5 text-light">
        <h1>Let's Play!</h1>
        <p class="text-center w-75">In this game, you may guess the name of the movie or TV show by it's cover, scene, cast,
            etc. You can make records, break them, go the leaderboards, play with your friend, challenge them and have fun.<br><span class="fw-bold fs-large">Join and play NOW!</span></p>
        <a class="btn btn-primary" href="{{ route('register') }}">Sign Up</a>
    </div>
@endsection
