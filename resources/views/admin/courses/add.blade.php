@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4>Add New Course</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf

        <div class="mb-3">
            <label>Course Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Course Code</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit for Approval</button>
    </form>
</div>
@endsection