@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-white">Approved Courses</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Requested By</th>
                <th>Approved Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->requested_by ?? 'N/A' }}</td>
                    <td>{{ $course->updated_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($course->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No approved courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
