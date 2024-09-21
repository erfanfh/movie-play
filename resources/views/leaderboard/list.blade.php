@extends('layouts.master')
@section('title', 'Leaderboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <img alt="leaderboard img" class="my-3" width="250" src="{{ asset('images/leaderboard.png') }}">
        </div>
        <h1 class="text-start border-bottom mb-3">Records</h1>
        @foreach($records as $key => $record)
            <div class="d-flex justify-content-between row align-items-center p-3 border border-dark rounded-3 mb-2">
                <span class="col-4">{{ $key+1 . " | " . $record->user->username }}</span>
                @php
                    $color = match ($key) {
                        0 => 'gold',
                        1 => 'gray',
                        2 => 'saddlebrown',
                        default => 'black',
                    };
                @endphp
                <span class="col-4 text-center" style="color: {{$color}}">Score: {{ $record->score }}</span>
                <span class="col-4 text-end">{{ $record->created_at->format('Y / m / d') }}</span>
            </div>
        @endforeach
    </div>
@endsection
