@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-white">Edit Admin</h3>

    <form method="POST" action="{{ url('/superadmin/admins/update/' . $admin->id) }}">
        @csrf
        <div class="mb-3">
            <label class="text-white">Name</label>
            <input type="text" name="name" value="{{ $admin->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="text-white">Email</label>
            <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update Admin</button>
    </form>
</div>
@endsection
