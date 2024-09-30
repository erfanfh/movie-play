@extends('layouts.master')
@section('title', 'Leaderboard')

@section('content')
    <div class="container mt-5  d-flex flex-column">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <img alt="leaderboard img" class="my-3" width="250" src="{{ asset('images/leaderboard.png') }}">
        </div>
        <h1 class="text-start border-bottom mb-3">Records</h1>
        @php
            $shouldContinue = true;
            $hasRecord = false;
        @endphp
        @foreach($records as $key => $record)
            @if($key > 19)
                @php
                    $shouldContinue = false;
                @endphp
            @endif
            @if($shouldContinue)
                @if($record->user == auth()->user())
                    @php
                        $hasRecord = true;
                    @endphp
                @endif
                <div
                        class="d-flex justify-content-between row align-items-center p-3 border border-dark rounded-3 mb-2 @if($record->user->id == auth()->user()->id) bg-success-subtle @endif ">
                    <span class="col-4">{{ $key+1 . " | " . $record->user->username }}</span>
                    @php
                        $color = match ($key) {
                            0 => 'gold' ,
                            1 => 'gray',
                            2 => 'saddlebrown',
                            default => 'black',
                        };
                    @endphp
                    <span class="col-4 text-center" style="color: {{$color}}">Score: {{ $record->score }}</span>
                    <span class="col-4 text-end">{{ $record->created_at->format('Y / m / d') }}</span>
                </div>
            @endif
        @endforeach
        @if(!$hasRecord)
            @php $executed = false;  @endphp
            @foreach($records as $key => $record)
                @if(!$executed)
                    @if($record->user == auth()->user())
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="gray"
                             class="bi bi-three-dots-vertical my-3 align-self-center"
                             viewBox="0 0 16 16">
                            <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        </svg>
                        <div
                                class="d-flex justify-content-between row align-items-center p-3 border border-dark rounded-3 mb-2 @if($record->user == auth()->user()) bg-success-subtle @endif ">
                            <span class="col-4">{{ $key+1 . " | " . $record->user->username }}</span>
                            @php
                                $color = match ($key) {
                                    0 => 'gold' ,
                                    1 => 'gray',
                                    2 => 'saddlebrown',
                                    default => 'black',
                                };

                                $executed = true;
                            @endphp
                            <span class="col-4 text-center" style="color: {{$color}}">Score: {{ $record->score }}</span>
                            <span class="col-4 text-end">{{ $record->created_at->format('Y / m / d') }}</span>
                        </div>
                    @endif
                @endif
            @endforeach
        @endempty
    </div>
@endsection
