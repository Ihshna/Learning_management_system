@extends('layouts.dashboard') 
<!-- resources/views/admin/liveclasses/index.blade.php -->

@section('content')
<div class="container mt-4">
    <h2>Live Classes</h2>

    <a href="{{ route('admin.liveclasses.create') }}" class="btn btn-success mb-3">Add New Live Class</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($liveClasses->isEmpty())
        <p>No live classes found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Meeting Link</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liveClasses as $liveClass)
                    <tr>
                        <td>{{ $liveClass->title }}</td>
                        <td>{{ $liveClass->description }}</td>
                        <td><a href="{{ $liveClass->meeting_link }}" target="_blank">Join Meeting</a></td>
                        <td>{{ $liveClass->start_time->format('Y-m-d H:i') }}</td>
                        <td>{{ $liveClass->end_time ? $liveClass->end_time->format('Y-m-d H:i') : '-' }}</td>
                        <td>{{ $liveClass->course->title ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.liveclasses.edit', $liveClass->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.liveclasses.destroy', $liveClass->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure to delete this live class?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $liveClasses->links() }}
    @endif
</div>
@endsection
