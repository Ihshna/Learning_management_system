@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4>Manage Students</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment No</th>
                <th>Enrollment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ $student->enrollment_no }}</td>
                    <td>{{ $student->enrollment_date }}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('admin.students.delete', $student->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection