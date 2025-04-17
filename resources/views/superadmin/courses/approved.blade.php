@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Approved Courses</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Description</th>
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            @forelse($approvedCourses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->created_by }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">No approved courses yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection