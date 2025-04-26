@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">Submitted Assignments</h3>

    <div class="row">
        @forelse($submissions as $submission)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $submission->assignment->title ?? 'Assignment' }}</h5>
                        <p class="card-text">{{ $submission->note ?? 'No additional notes.' }}</p>

                        <p class="text-muted small">Submitted On: {{ \Carbon\Carbon::parse($submission->created_at)->format('d M Y') }}</p>

                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-success btn-sm mt-auto w-100">
                            View Submission
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    You have not submitted any assignments yet.
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection