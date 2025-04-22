@extends('student.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Assignments</h2>

    @if(count($assignments) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->course->name ?? 'N/A' }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->description }}</td>
                        <td>{{ $assignment->due_date }}</td>
                        <td>
                            <!-- Submit Button -->
                            <a href="{{ route('student.assignment.submit', $assignment->id) }}" class="btn btn-primary btn-sm">Submit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No assignments found.</p>
    @endif
</div>
@endsection
