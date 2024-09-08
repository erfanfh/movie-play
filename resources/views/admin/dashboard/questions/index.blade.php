@extends('admin.dashboard.master')

@section('content')
    <div class="h2">Add new question</div>
    <form action="{{ route('dashboard.questions.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label for="formFile" class="form-label">Poster</label>
            <input class="form-control" name="poster" type="file" id="formFile">
        </div>
        @error('poster')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-3">
            <label class="form-label">Answer</label>
            <input type="text" name="answer" class="form-control">
        </div>
        @error('answer')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Add</button>
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('message') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-2">{{ session('message') }}</div>
        @endif
    </form>
    <div class="h2">Questions</div>
    <hr>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Answer</th>
                <th scope="col">Action</th>
                <th scope="col">
                    Created at
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                        <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                    </svg>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $key => $question)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="{{ asset('images') . '/' . $question->image }}">Image</a></td>
                    <td>{{ $question->answer->text }}</td>
                    <td><a href="{{ route('dashboard.questions.show', $question) }}">Edit</a></td>
                    <td>{{ $question->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $questions->links() }}
@endsection
