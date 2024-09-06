@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="card mt-5" style="width: 18rem;">
            <div class="card-body text-center">
                <h5 class="card-title">Guess the movie</h5>
                <p class="card-text">In this game you should guess the movie name or TV show name or anime name by it's
                    poster</p>
                <a href="{{ route('question.show') }}" class="card-link btn btn-primary">Let's play</a>
            </div>
        </div>
    </div>
@endsection
