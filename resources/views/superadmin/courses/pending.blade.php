@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Pending Course Requests</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Requested By</th>
                <th>Date Requested</th>
                <th>Status</th>
                <!-- Optional Actions -->
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->requested_by }}</td>
                    <td>{{ $course->created_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($course->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No pending courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
