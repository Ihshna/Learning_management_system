@extends('student.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Submitted Assignments</h2>

    @if(count($submissions) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Submitted File</th>
                    <th>Notes</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->assignment->course->name ?? 'N/A' }}</td>
                        <td>{{ $submission->assignment->title }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $submission->submission_file) }}" target="_blank" class="btn btn-info btn-sm">View File</a>
                        </td>
                        <td>{{ $submission->notes }}</td>
                        <td>{{ $submission->submitted_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No submitted assignments found.</p>
    @endif
</div>
@endsection
