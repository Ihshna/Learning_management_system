@extends('layouts.dashboard') 
<!-- resources/views/admin/liveclasses/create.blade.php -->



@section('content')
<div class="container mt-4">
    <h2>Create New Live Class</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.liveclasses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Class Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Class Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="meeting_link" class="form-label">Meeting Link (Zoom/Google Meet URL)</label>
            <input type="url" name="meeting_link" id="meeting_link" class="form-control" value="{{ old('meeting_link') }}" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time (Optional)</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}">
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select">
                <option value="">Select Course (optional)</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Live Class</button>
        <a href="{{ route('admin.liveclasses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
