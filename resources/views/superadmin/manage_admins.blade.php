@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">Manage Admins</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-dark table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ url('/superadmin/admins/'.$admin->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ url('/superadmin/admins/'.$admin->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this admin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
