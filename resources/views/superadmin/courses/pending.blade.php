@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Pending Course Requests</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Description</th>
                <th>Requested By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingCourses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->created_by }}</td>
                    <td>
                        <form action="{{ route('superadmin.courses.approve', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('superadmin.courses.reject', $course->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No pending requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection