@extends('layouts.dashboard') 

@section('content')
<div class="container py-4">
    <h3>Add New Lecture Recording</h3>

    <form method="POST" action="{{ route('admin.lecture_recordings.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Lecture Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Lecture Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">YouTube Video Link</label>
            <input type="url" name="file_path" class="form-control" placeholder="https://www.youtube.com/..." required>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Related Course (optional)</label>
            <select name="course_id" class="form-select">
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Recording</button>
    </form>
</div>
@endsection