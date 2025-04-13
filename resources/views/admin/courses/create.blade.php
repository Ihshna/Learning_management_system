@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3>Add Course</h3>
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Course Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Course Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit for Approval</button>
    </form>
</div>
@endsection