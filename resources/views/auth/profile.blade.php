@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column justify-content-center px-3 px-md-5 gap-3">
        <div class="username-box">
            <h5 class="mb-2">Username</h5>
            <ul class="list-group mb-2">
                <li class="list-group-item">{{ auth()->user()->username }}</li>
            </ul>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit account detail</a>
            <h5 class="my-2">Record</h5>
            <ul class="list-group mb-2">
                <li class="list-group-item">{{ $bestRecord ? $bestRecord->score : 0 }}</li>
            </ul>
        </div>
        <div>
            <h5 class="mb-2">Record
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"/>
                </svg>
            </h5>
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Score</th>
                        <th scope="col">Date
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                                <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            </svg>
                        </th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($bestRecord)
                        <tr>
                            <td>{{ 1 }}</td>
                            <td>{{ $bestRecord->score}}</td>
                            <td>{{ $bestRecord->created_at->format('m/d/Y') }}</td>
                            <td>{{ $bestRecord->created_at->format('H:m:i') }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <h5 class="mb-2">History</h5>
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Score</th>
                        <th scope="col">Date
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                                <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                            </svg>
                        </th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memories as $key => $memory)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $memory->score }}</td>
                            <td>{{ $memory->created_at->format('m/d/Y') }}</td>
                            <td>{{ $memory->created_at->format('H:m:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $memories->links() }}
            </div>
        </div>
    </div>
@endsection
