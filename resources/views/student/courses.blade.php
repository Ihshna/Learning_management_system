@extends('student.layout')

@section('content')
    <h2>My Courses</h2>

    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <p><strong>Status:</strong> 
                                @if($course->status == 'approved') <span class="text-success">Approved</span>
                                @elseif($course->status == 'pending') <span class="text-warning">Pending Approval</span>
                                @else <span class="text-danger">Rejected</span> @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>You have not enrolled in any courses yet.</p>
    @endif
@endsection
