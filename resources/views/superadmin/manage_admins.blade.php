@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-white">Manage Admins</h3>

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
                    <td class="d-flex gap-1">
                        <!-- Edit Button -->
                        <a href="{{ url('/superadmin/admins/edit/' . $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
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
