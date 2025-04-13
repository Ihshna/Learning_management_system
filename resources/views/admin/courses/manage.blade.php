@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Manage Courses</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Course Title</th>
                <th>Course Code</th>
                <th>Description</th>
                <th>Created_by</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->creator->name ?? 'N/A'}}</td>
                    <td>
                        @if($course->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($course->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($course->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $course->created_at->format('d M Y') }}</td>
                    <td>
                        @if($course->status == 'pending')
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @else
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection