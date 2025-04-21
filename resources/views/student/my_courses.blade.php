@extends('student.layout')

@section('content')
    <h2 class="mb-4">🎓 My Courses</h2>

    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">{{ $course->description }}</p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                @if($course->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($course->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending Approval</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            You have not enrolled in any courses yet.
        </div>
    @endif
@endsection
