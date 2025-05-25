@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Edit Live Class</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.liveclasses.update', $liveClass->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $liveClass->title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $liveClass->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="meeting_link" class="form-label">Meeting Link</label>
            <input type="url" name="meeting_link" value="{{ old('meeting_link', $liveClass->meeting_link) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($liveClass->start_time)->format('Y-m-d\TH:i')) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time (optional)</label>
            <input type="datetime-local" name="end_time" value="{{ old('end_time', $liveClass->end_time ? \Carbon\Carbon::parse($liveClass->end_time)->format('Y-m-d\TH:i') : '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" class="form-control">
                <option value="">Select a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $liveClass->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Live Class</button>
        <a href="{{ route('admin.liveclasses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
