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
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 80) }}</p>

                        <div class="mt-auto">
                            <!-- View Details Button -->
                            <a href="{{ route('student.course.show', $course->id) }}" class="btn btn-primary btn-sm w-100 mb-2">View Details</a>

                            <!-- Join Course Button -->
                            @php
                               $student = \App\Models\Student::where('user_id', auth()->id())->first();
                               $enrolled = $student ? $student->courses->contains($course->id) : false;
                               $courseRequest = \App\Models\CourseRequest::where('student_id', auth()->id())
                                 ->where('course_id', $course->id)
                                 ->first();
                            @endphp

                            @if($enrolled)
                                  <button class="btn btn-secondary btn-sm w-100" disabled>Already Enrolled</button>
                            @elseif($courseRequest)
                                <button class="btn btn-warning btn-sm w-100" disabled>{{ ucfirst($courseRequest->status) }}</button>
                            @else
                               <form method="POST" action="{{ route('student.course.request', $course->id) }}">
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
                <div class="alert alert-info">No courses available at the moment.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection