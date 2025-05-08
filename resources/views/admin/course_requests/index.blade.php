@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Pending Course Join Requests</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($requests as $req)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $req->student->name }}</h5>
                        <p class="card-text mb-1">
                            <strong>Course:</strong> {{ $req->course->title }}
                        </p>
                        <p class="text-muted small mb-3">
                            Requested on: {{ $req->created_at->format('d M Y') }}
                        </p>

                        <form method="POST" action="{{ route('admin.course.requests.approve', $req->id) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-sm">
                                <i class="fas fa-check me-1"></i> Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.course.requests.reject', $req->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 btn-sm">
                                <i class="fas fa-times me-1"></i> Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No pending course requests at the moment.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection