@extends('student.layout')

@section('content')
    <h2>Available Courses</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($courses->count() > 0)
        <div class="row mt-4">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <p><strong>Instructor:</strong> {{ $course->created_by }}</p>

                            <form action="{{ route('student.joinCourse', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Join Course</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No available courses to join right now.</p>
    @endif
@endsection
