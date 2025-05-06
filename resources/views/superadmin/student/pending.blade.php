@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Pending Student Requests</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th> Name</th>
                <th>Student Id</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('superadmin.student.approve', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('superadmin.student.reject', $user->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No pending requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection