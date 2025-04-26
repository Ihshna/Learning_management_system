@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">My Courses</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-success">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                        

                        <div class="mt-auto">
                            <!-- View Details Button -->
                            <a href="{{ route('student.course.show', $course->id) }}" class="btn btn-primary btn-sm w-100 mb-2">View Details</a>

                            <!-- Leave Course Button -->
                            <form method="POST" action="{{ route('student.course.leave', $course->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100">Leave Course</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">You are not enrolled in any courses yet.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection