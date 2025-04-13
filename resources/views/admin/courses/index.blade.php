@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3>Manage Courses</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Add Course</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Code</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection