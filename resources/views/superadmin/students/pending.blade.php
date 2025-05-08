@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Pending Student Requests</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->created_at->format('d M Y') }}</td>
                    <td>
                        <form method="POST" action="{{ route('superadmin.students.approve', $student->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('superadmin.students.reject', $student->id) }}" class="d-inline ms-2">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No pending student requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection