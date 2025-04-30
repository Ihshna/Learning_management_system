@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h3>Lecture Recordings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.lecture_recordings.create') }}" class="btn btn-success mb-3">Add New Recording</a>

    <div class="row">
        @forelse($recordings as $recording)
            <div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title">{{ $recording->title }}</h5>
        <p class="card-text">{{ $recording->description }}</p>

        <div class="ratio ratio-16x9" style="max-width:450px; margin:auto;">
            <iframe 
                src="{{ str_replace('watch?v=', 'embed/', $recording->file_path) }}" 
                frameborder="0" 
                allowfullscreen
                class="rounded">
            </iframe>
        </div>
        <form action="{{ route('admin.lecture-recordings.destroy', $recording->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recording?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger mt-2">
                <i class="fas fa-trash-alt me-1"></i> Remove Recording
            </button>
        </form>
    </div>
</div>
        @empty
            <div class="alert alert-info">No lecture recordings available yet.</div>
        @endforelse
    </div>

</div>
@endsection