<!-- resources/views/student/available_courses.blade.php -->

@extends('student.layout')

@section('content')
    <div class="container">
        <h1 class="my-4">Available Courses</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($courses->isEmpty())
            <div class="alert alert-warning" role="alert">
                There are no available courses at the moment.
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
                                <a href="{{ route('student.course.details', $course->id) }}" class="btn btn-primary mb-2">View Details</a>

                                <!-- Join Course Form -->
                                <form action="{{ route('student.course.join', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Join Course</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
