@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">Edit Admin</h3>

    <form method="POST" action="{{ url('/superadmin/admins/'.$admin->id.'/update') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="text-white">Name</label>
                <input type="text" name="name" value="{{ $admin->name }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-white">Email</label>
                <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update Admin</button>
        <a href="{{ url('/superadmin/admins') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
