@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Submitted Assignments</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Assignment</th>
                <th>Student Name</th>
                <th>Submitted File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr>
                    <td>{{ $submission->assignment->title }}</td>
                    <td>{{ $submission->student->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ asset($submission->file_path) }}" target="_blank">View File</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No submissions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
