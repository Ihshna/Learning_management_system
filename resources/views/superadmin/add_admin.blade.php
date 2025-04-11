@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">Add New Admin</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ url('/superadmin/admins') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="text-white">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-white">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-white">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Admin</button>
    </form>
</div>
@endsection

