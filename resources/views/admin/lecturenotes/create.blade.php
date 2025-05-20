@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Upload Lecture Note</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.lecturenotes.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Lecture Number</label>
            <input type="text" name="lecture_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lecture Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload PDF</label>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
