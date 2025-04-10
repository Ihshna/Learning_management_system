@extends('layouts.dashboard') {{-- or your main layout --}}

@section('content')
<div class="container mt-4">
    <h4>Add New Student</h4>
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
</div>
@endif

    <form method="POST" action="{{ route('admin.students.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Enrollment Number</label>
            <input type="text" name="enrollment_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Enrollment Date</label>
            <input type="date" name="enrollment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>
@endsection