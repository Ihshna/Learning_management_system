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
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr>
                    <td>{{ $submission->assignment->title }}</td>
                    <td>{{ $submission->student->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">View File</a>
                    </td>
                    <td>{{ $submission->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No submissions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
