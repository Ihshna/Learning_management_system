@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm p-4">
        <h2 class="text-primary">{{ $course->title }}</h2>

        <p class="mt-3">{{ $course->description }}</p>

        <ul class="list-group mt-4">
            <li class="list-group-item"><strong>Course Code:</strong> {{ $course->code ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Created By:</strong> {{ $course->created_by ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($course->status) }}</li>
        </ul>

        <a href="{{ route('student.mycourses') }}" class="btn btn-secondary mt-4">Back to My Courses</a>
    </div>

</div>
@endsection