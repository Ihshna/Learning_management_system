@extends('student.layout')

@section('content')
    <h2>Your Submitted Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Assignment Title</th>
                <th>Submitted On</th>
                <th>Notes</th>
                <th>Download File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr>
                    <td>{{ $submission->assignment->title }}</td>
                    <td>{{ $submission->submitted_at->format('d M Y - h:i A') }}</td>
                    <td>{{ $submission->notes ?? 'N/A' }}</td>
                    <td><a href="{{ asset('storage/' . $submission->submission_file) }}" target="_blank">Download</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">You haven't submitted any assignments yet.</td>
                </tr>
                @endforelse
        </tbody>
    </table>
@endsection
