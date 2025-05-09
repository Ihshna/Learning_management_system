@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">My Assignments</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($assignments as $assignment)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $assignment->title }}</h5>
                        <p class="card-text">{{ Str::limit($assignment->description, 100) }}</p>
                        <p class="text-muted small">Due Date: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}</p>

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
