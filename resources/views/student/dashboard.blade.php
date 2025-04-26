@extends('layouts.dashboard') 

@section('content')
<div class="container-fluid py-4">

    <!-- Greeting -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Welcome back, {{ auth()->user()->name }}!</h3>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" alt="Profile" class="rounded-circle" width="50">
    </div>

    <!-- Stat Cards with Progress -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <h3 class="fw-bold">{{ $projects }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%">80%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Courses</h5>
                    <h3 class="fw-bold">{{ $courses }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%">65%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
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
        <div class="col-md-8">
            <h4>Lecture Recordings</h4>
            @forelse($recordings as $rec)
                <div class="card mb-2 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title">{{ $rec->title }}</h6>
                        <p class="card-text">{{ $rec->description }}</p>
                        <a href="{{ asset('storage/' . $rec->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">Watch Now</a>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No recordings yet.</div>
            @endforelse
        </div>

        <!-- Right: Notifications -->
        <div class="col-md-4">
            <h4>Notifications</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-bell me-2 text-warning"></i> Assignment due this week</li>
                        <li><i class="fas fa-book me-2 text-success"></i> New course added</li>
                        <li><i class="fas fa-star me-2 text-primary"></i> Your profile is 90% complete</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom: Upcoming Events -->
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