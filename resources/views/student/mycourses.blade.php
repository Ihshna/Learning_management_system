@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <h3 class="mb-4">My Courses</h3>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <a href="#" class="btn btn-primary btn-sm mt-2">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    You are not enrolled in any courses yet.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection