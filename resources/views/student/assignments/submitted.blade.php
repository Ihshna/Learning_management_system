@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">📚 My Submitted Assignments</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($submissions as $submission)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary fw-bold">{{ $submission->assignment->title ?? 'Untitled Assignment' }}</h5>

                        <p class="card-text text-muted">
                            {{ $submission->note ?? 'No notes added.' }}
                        </p>

                        <p class="text-secondary small">
                            📅 Submitted on: {{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y H:i') }}
                        </p>

                        <a href="{{ asset($submission->file_path) }}" target="_blank" class="btn btn-outline-success mt-auto">
                            📄 View Submission
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    You haven't submitted any assignments yet.
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
