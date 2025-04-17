@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Manage Admins</h2>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $index => $admin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('superadmin.admins.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this admin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No admins found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection