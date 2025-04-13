@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="text-dark mb-4">Add New Admin</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ url('/superadmin/admins/add') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label text-dark">Name</label>
            <input type="text" name="name" id="name" class="form-control text-dark bg-light" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-dark">Email</label>
            <input type="email" name="email" id="email" class="form-control text-dark bg-light" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-dark">Password</label>
            <input type="password" name="password" id="password" class="form-control text-dark bg-light" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control text-dark bg-light" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Add Admin</button>
    </form>
</div>
@endsection
