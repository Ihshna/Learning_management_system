@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h3 class="text-primary">{{ $note->lecture_number }} – {{ $note->title }}</h3>

    <p class="text-muted mb-3">Here is your lecture note. You can view it below or download it.</p>

    <div class="mb-4">
        <iframe src="{{ asset($note->file_path) }}" width="100%" height="500px" style="border: 1px solid #ccc;"></iframe>
    </div>

    <a href="{{ asset($note->file_path) }}" download class="btn btn-success">
        <i class="fas fa-download me-1"></i> Download File
    </a>
</div>
@endsection
