@extends('student.layout') <!-- Your main layout -->

@section('content')
    <div class="container">
        <h1 class="my-4">My Courses</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($courses->isEmpty())
            <div class="alert alert-warning" role="alert">
                You are not enrolled in any courses yet.
            </div>
        @else
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title">{{ $course->title }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ Str::limit($course->description, 100) }}</p>

                                <!-- Smaller Buttons side by side, equal width -->
                                <div class="d-flex justify-content-center gap-2 w-75 mx-auto">
                                    <a href="{{ route('student.course.details', $course->id) }}" class="btn btn-primary w-100">
                                        View
                                    </a>

                                    <form action="{{ route('student.course.leave', $course->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to leave this course?');" class="w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">Leave</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                Enrolled on: {{ $course->pivot->created_at ? $course->pivot->created_at->format('d M, Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
