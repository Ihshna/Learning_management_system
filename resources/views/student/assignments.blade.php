@extends('student.layout')

@section('content')
    <h2>My Assignments</h2>

    @if(count($assignments) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->course->title }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->description }}</td>
                        <td>{{ $assignment->due_date }}</td>
                        <td>{{ ucfirst($assignment->status) }}</td>
                        <td><a href="{{ route('student.assignment.submit', $assignment->id) }}" class="btn btn-primary btn-sm">Submit</a></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
    @else
        <p>No assignments found for your courses.</p>
    @endif
@endsection

