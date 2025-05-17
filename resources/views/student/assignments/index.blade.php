@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">My Assignments</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($assignments as $assignment)
            @php
                $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                $now = \Carbon\Carbon::now();

                $totalRemainingMinutes = $now->diffInMinutes($dueDate, false);

                $remainingDays = intdiv($totalRemainingMinutes, 60 * 24);
                $remainingHours = intdiv($totalRemainingMinutes % (60 * 24), 60);
                $remainingMinutes = $totalRemainingMinutes % 60;

                // Decide badge color class
                if ($totalRemainingMinutes > 0) {
                    $badgeClass = 'bg-success';
                } elseif ($totalRemainingMinutes === 0) {
                    $badgeClass = 'bg-warning text-dark';
                } else {
                    $badgeClass = 'bg-danger';
                }
            @endphp

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm position-relative">

                    {{-- Remaining time badge top-right --}}
                    <div style="position: absolute; top: 10px; right: 10px; z-index: 10;"
                         class="badge {{ $badgeClass }} p-2 text-wrap" 
                         title="Assignment due time remaining"
                         >
                        @if($totalRemainingMinutes > 0)
                            @if($remainingDays > 0)
                                {{ $remainingDays }}d
                            @endif
                            @if($remainingHours > 0)
                                {{ $remainingHours }}h
                            @endif
                            @if($remainingMinutes > 0)
                                {{ $remainingMinutes }}m
                            @endif
                        @elseif($totalRemainingMinutes === 0)
                            Due now
                        @else
                            Past due
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $assignment->title }}</h5>
                        <p class="card-text">{{ Str::limit($assignment->description, 100) }}</p>

                        <p class="text-muted small mb-1">
                            Due Date: {{ $dueDate->format('d M Y h:i A') }}
                        </p>

                        <div class="mt-auto">
                            @if($assignment->is_submitted)
                                <button class="btn btn-success btn-sm w-100 mt-2" disabled>Already Submitted</button>
                            @else
                                <a href="{{ route('student.assignment.submit', $assignment->id) }}" class="btn btn-primary btn-sm w-100 mt-2">Submit Assignment</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No assignments available for your courses yet.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
