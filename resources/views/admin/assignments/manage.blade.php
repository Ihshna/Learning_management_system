@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Manage Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Course</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->course->title ?? 'N/A' }}</td>
                    <td>{{ $assignment->due_date }}</td>
                    <td>
                        @if($assignment->submissions->count() > 0)
                            Submitted
                        @else
                            Pending
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.assignments.edit', $assignment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('admin.assignments.delete', $assignment->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No assignments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
