@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <!-- Greeting -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Welcome back, {{ auth()->user()->name }}!</h3>
    </div>

    <!-- Stat Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <h3 class="fw-bold">{{ $projects }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>
                    <h3 class="fw-bold">{{ $coursesCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Members</h5>
                    <h3 class="fw-bold">{{ $members }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Lecture Recordings + Assignments -->
    <div class="row mb-4">

        <!-- Lecture Recordings (Left) -->
        <div class="col-md-8">
            <h4>Lecture Recordings</h4>

            <!-- Course Filter -->
            <form method="GET" action="{{ route('student.dashboard') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-9">
                        <select name="course_id" class="form-select">
                            <option value="">-- Filter by Course --</option>
                            @foreach($courseList as $course)
                                <option value="{{ $course->id }}" {{ $course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>

            @forelse($recordings as $rec)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">{{ $rec->title }}</h6>
                        <p class="text-muted small">Course: {{ $rec->course->title ?? 'N/A' }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <div style="width: 100%; max-width: 500px; aspect-ratio: 16 / 9;">
                                <iframe 
                                    src="{{ str_replace('watch?v=', 'embed/', $rec->file_path) }}" 
                                    frameborder="0" 
                                    allowfullscreen 
                                    class="w-100 h-100 rounded">
                                </iframe>
                            </div>
                        </div>
                        <p class="card-text small mt-2">{{ $rec->description }}</p>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No lecture recordings yet.</div>
            @endforelse
        </div>

        <!-- Assignments (Right) -->
        <div class="col-md-4">
            <h4>Pending Assignments</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-unstyled">
                        @forelse($assignments as $assignment)
                            @if(!$assignment->is_submitted)
                                @php
                                    $now = now();
                                    $due = \Carbon\Carbon::parse($assignment->due_date);
                                    $remaining = $now->diff($due);
                                    $isPastDue = $now->gt($due);

                                    $remainingText = $isPastDue
                                        ? 'Past due'
                                        : "{$remaining->d}d {$remaining->h}h {$remaining->i}m remaining";

                                    $textClass = $isPastDue ? 'text-danger' : 'text-muted';
                                @endphp

                                <li class="mb-3">
                                    <i class="fas fa-bell me-2 text-warning"></i>
                                    <strong>{{ $assignment->title }}</strong><br>
                                    <small class="text-primary">Course: {{ $assignment->course->title ?? 'N/A' }}</small><br>
                                    <small class="{{ $textClass }}">{{ $remainingText }}</small>
                                </li>
                            @endif
                        @empty
                            <li><i class="fas fa-check-circle me-2 text-success"></i> No pending assignments</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="row">
        <div class="col-md-12">
            <h4>Upcoming Events</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($events as $event)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $event->title }}</span>
                                <span class="badge bg-dark">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </li>
                        @empty
                            <li class="list-group-item">No upcoming events.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
