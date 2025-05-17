@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <!-- Greeting -->
    <div class="d-flex justify-content-between align-items-center mb-4 animate_animated animate_fadeInDown">
        <h3>Welcome back, {{ auth()->user()->name }}!</h3>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="Profile" class="rounded-circle" width="50">
    </div>

    <!-- Stat Cards with Progress -->
    <div class="row mb-4">
        <div class="col-md-4 animate_animated animate_fadeInLeft">
            <div class="card shadow-sm hover-effect">
                <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <h3 class="fw-bold">{{ $projects }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%">80%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate_animated animate_fadeInUp">
            <div class="card shadow-sm hover-effect">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>
                    <h3 class="fw-bold">{{ $courses }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%">65%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate_animated animate_fadeInRight">
            <div class="card shadow-sm hover-effect">
                <div class="card-body">
                    <h5 class="card-title">Members</h5>
                    <h3 class="fw-bold">{{ $members }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 90%">90%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lecture Recordings + Notifications -->
    <div class="row mb-4">
        <!-- Left: Lecture Recordings -->
        <div class="col-md-8 animate_animated animate_fadeInUp">
            <h4>Lecture Recordings</h4>
            @forelse($recordings as $rec)
                <div class="card mb-4 shadow-sm hover-effect">
                    <div class="card-body">
                        <h6 class="card-title">{{ $rec->title }}</h6>

                        <div class="ratio ratio-16x9" style="max-width:450px; margin:auto;">
                            <iframe 
                                src="{{ str_replace('watch?v=', 'embed/', $rec->file_path) }}" 
                                frameborder="0" allowfullscreen class="rounded">
                            </iframe>
                        </div>

                        <p class="card-text small">{{ $rec->description }}</p>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No lecture recordings yet.</div>
            @endforelse
        </div>

        <!-- Right: Notifications -->
        <div class="col-md-4 animate_animated animate_fadeInUp">
            <h4>Pending Assignments For You</h4>
            <div class="card shadow-sm hover-effect">
                <div class="card-body">
                    <ul class="list-unstyled">
                        @forelse($assignments as $assignment)
                            @php
                                $remaining = now()->diffInMinutes($assignment->due_date, false);
                                $hours = floor($remaining / 60);
                                $minutes = $remaining % 60;
                                $remainingText = $remaining > 0
                                    ? "{$hours}h {$minutes}m remaining"
                                    : 'Past due';
                                $textClass = $remaining > 0 ? 'text-muted' : 'text-danger';
                            @endphp

                            @if(!$assignment->is_submitted)
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

    <!-- Bottom: Upcoming Events -->
    <div class="row">
        <div class="col-md-12 animate_animated animate_fadeInUp">
            <h4>Upcoming Events</h4>
            <div class="card shadow-sm hover-effect">
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
