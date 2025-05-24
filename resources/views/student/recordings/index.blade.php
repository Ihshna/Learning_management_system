@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Lecture Recordings for {{ $course->title }}</h3>

    <div class="row">
        @forelse($recordings as $rec)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $rec->title }}</h5>
                        <p class="text-muted small">Course: {{ $rec->course->title ?? 'N/A' }}</p>
                        
                        <div class="mb-3" style="aspect-ratio: 16 / 9;">
                            <iframe 
                                src="{{ str_replace('watch?v=', 'embed/', $rec->file_path) }}" 
                                frameborder="0" 
                                allowfullscreen 
                                class="w-100 h-100 rounded">
                            </iframe>
                        </div>
                        
                        <p class="card-text small mt-auto">{{ $rec->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No lecture recordings available for this course.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
