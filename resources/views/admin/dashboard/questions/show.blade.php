@extends('admin.dashboard.master')

@section('content')
    <div class="h2">Question Details</div>
    <hr>
    <img style="border-radius: 10px; width: 200px;" src="{{ asset('images') . '/' . $question->image }}" alt="movie poster">
    <form action="{{ route('dashboard.questions.update', $question) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label for="formFile" class="form-label">Poster</label>
            <input class="form-control" name="poster" type="file" id="formFile">
        </div>
        @error('poster')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="mt-3">
            <label class="form-label">Answer</label>
            <input type="text" name="answer" class="form-control" value="{{ $question->answer->text }}">
        </div>
        @error('answer')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-3">Edit</button>
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
        @endif
    </form>
    <form action="{{ route('dashboard.questions.destroy', $question) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the question?')">Delete</button>
    </form>
@endsection
