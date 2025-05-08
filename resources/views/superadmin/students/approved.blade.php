@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Approved Students</h4>

    <div class="row">
        @forelse($students as $student)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $student->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
                        <p class="card-text"><strong>Joined:</strong> {{ $student->created_at->format('d M Y') }}</p>
                        <span class="badge bg-success">Approved</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No approved students found.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

