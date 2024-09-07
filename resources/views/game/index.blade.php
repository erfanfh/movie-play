@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-center align-items-center header" style="height: 100vh">
        <div class="card mt-5" style="width: 18rem;">
            <div class="card-body text-center">
                <h5 class="card-title">Guess the movie</h5>
                <p class="card-text">In this game you should guess the movie name or TV show name or anime name by it's
                    poster</p>
                @if($memories->all())
                    <div>
                        <a href="{{ route('question.show') }}" class="card-link btn btn-warning">Continue</a>
                        <a href="{{ route('question.playover') }}" class="card-link btn btn-primary">Play over</a>
                    </div>
                    <div class="mt-1 text-secondary">You can finish your game until {{ $memories->first()->updated_at->addWeek() }}</div>
                @else
                    <a href="{{ route('question.show') }}" class="card-link btn btn-primary">Play a game</a>
                @endif
            </div>
        </div>
    </div>
@endsection
