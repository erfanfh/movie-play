@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center px-5 gap-5">
        <div class="h2 align-self-start">Score: {{ auth()->user()->memories->where('is_active', 1)->first()->score }}</div>
        <img src="{{ asset('images') . '/' . $question->image }}" alt="movie poster" class="movie-poster">
        <form action="{{ route('question.checkAnswer', $question) }}" method="post" class="d-flex flex-column gap-1">
            @csrf
            <div>
                <input type="text" name="answer" class="form-control">
                <div class="form-text">What's this poster for?</div>
            </div>
            <button type="submit" class="btn btn-success">Next</button>
        </form>
    </div>
    <div class="question-cover"></div>
@endsection
