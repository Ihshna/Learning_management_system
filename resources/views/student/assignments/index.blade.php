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
            @endphp

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $assignment->title }}</h5>
                        <p class="card-text">{{ Str::limit($assignment->description, 100) }}</p>

                        <p class="text-muted small mb-1">
                            Due Date: {{ $dueDate->format('d M Y h:i A') }}
                        </p>

                        {{-- Remaining time display --}}
                        <p class="small fw-bold
                            @if($totalRemainingMinutes > 0) text-success
                            @elseif($totalRemainingMinutes === 0) text-warning
                            @else text-danger
                            @endif">
                            @if($totalRemainingMinutes > 0)
                                @if($remainingDays > 0)
                                    {{ $remainingDays }} day{{ $remainingDays > 1 ? 's' : '' }}
                                    @if($remainingHours > 0 || $remainingMinutes > 0)
                                        ,
                                    @endif
                                @endif

                                @if($remainingHours > 0)
                                    {{ $remainingHours }} hour{{ $remainingHours > 1 ? 's' : '' }}
                                    @if($remainingMinutes > 0)
                                        and
                                    @endif
                                @endif

                                @if($remainingMinutes > 0)
                                    {{ $remainingMinutes }} minute{{ $remainingMinutes > 1 ? 's' : '' }}
                                @endif
                                remaining
                            @elseif($totalRemainingMinutes === 0)
                                Due now!
                            @else
                                Past due by
                                @php
                                    $absDays = abs($remainingDays);
                                    $absHours = abs($remainingHours);
                                    $absMinutes = abs($remainingMinutes);
                                @endphp

                                @if($absDays > 0)
                                    {{ $absDays }} day{{ $absDays > 1 ? 's' : '' }}
                                    @if($absHours > 0 || $absMinutes > 0)
                                        ,
                                    @endif
                                @endif

                                @if($absHours > 0)
                                    {{ $absHours }} hour{{ $absHours > 1 ? 's' : '' }}
                                    @if($absMinutes > 0)
                                        and
                                    @endif
                                @endif

                                @if($absMinutes > 0)
                                    {{ $absMinutes }} minute{{ $absMinutes > 1 ? 's' : '' }}
                                @endif
                            @endif
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
