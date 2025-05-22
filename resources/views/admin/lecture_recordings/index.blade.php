@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Lecture Recordings</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.lecture_recordings.create') }}" class="btn btn-success mb-4">Add New Recording</a>

    <div class="row">
        @forelse($recordings as $recording)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $recording->title }}</h5>
                        <p class="card-text">{{ $recording->description }}</p>

                        <div class="ratio ratio-16x9 mb-3">
                            <iframe 
                                src="{{ str_replace('watch?v=', 'embed/', $recording->file_path) }}" 
                                frameborder="0" 
                                allowfullscreen
                                class="rounded w-100">
                            </iframe>
                        </div>

                        <form action="{{ route('admin.lecture-recordings.destroy', $recording->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recording?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-auto">
                                <i class="fas fa-trash-alt me-1"></i> Remove Recording
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No lecture recordings available yet.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
