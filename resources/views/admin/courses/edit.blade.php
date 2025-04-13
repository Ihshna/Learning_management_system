@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h3>Edit Course</h3>

    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Course Title</label>
            <input type="text" name="title" value="{{ $course->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" name="code" value="{{ $course->code }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ $course->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="{{ route('admin.courses.manage') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection