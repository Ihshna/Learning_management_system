@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Assignment</h2>

    <form action="{{ route('admin.assignments.update', $assignment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $assignment->title }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $assignment->description }}</textarea>
        </div>
        <div class="mb-3">
    <label for="course_id" class="form-label text-dark">Select Approved Course</label>
    <select name="course_id" id="course_id" class="form-select bg-white text-dark" required>
        <option value="">-- Select Approved Course --</option>
        @foreach($courses as $course)
            <option 
                value="{{ $course->id }}" 
                {{ $assignment->course_id == $course->id ? 'selected' : '' }}
                style="background-color: white; color: black;"
            >
                {{ $course->title }}
            </option>
        @endforeach
    </select>
</div>
        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ $assignment->due_date }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection