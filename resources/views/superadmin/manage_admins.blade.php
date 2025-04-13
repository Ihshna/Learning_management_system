@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Manage Admins</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $index => $admin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('admin.delete', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <!-- Optional: Add Edit button -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No admins found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
