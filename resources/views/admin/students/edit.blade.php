@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h4>Edit Student</h4>

    <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $student->user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $student->user->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Enrollment No</label>
            <input type="text" name="enrollment_no" value="{{ $student->enrollment_no }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Enrollment Date</label>
            <input type="date" name="enrollment_date" value="{{ $student->enrollment_date }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection