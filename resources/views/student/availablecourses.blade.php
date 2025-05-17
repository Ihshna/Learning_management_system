@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <h3 class="mb-4">Available Courses</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($courses as $course)
            @php
                $status = DB::table('course_student')
                            ->where('student_id', auth()->id())
                            ->where('course_id', $course->id)
                            ->value('status');
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 80) }}</p>

                        <div class="mt-auto">
                            <!-- View Details -->
                            <a href="{{ route('student.course.show', $course->id) }}" class="btn btn-primary btn-sm w-100 mb-2">View Details</a>

                            @if ($status === 'pending')
                                <button class="btn btn-warning btn-sm w-100" disabled>Pending</button>
                            @elseif ($status === 'approved')
                                <button class="btn btn-success btn-sm w-100" disabled>Already Enrolled</button>
                            @else
                                <form method="GET" action="{{ route('student.course.payment.form', $course->id) }}">
    @csrf
    <button type="submit" class="btn btn-success btn-sm w-100">Join Course</button>
</form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No courses available at the moment.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
