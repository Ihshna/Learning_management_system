@extends('layouts.dashboard')
@section('content')
<div class="container py-4">
    <h3>Submit Payment for {{ $course->title }}</h3>

    <form method="POST" action="{{ route('student.course.payment.submit', $course->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Student Name:</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
        </div>

        <div class="mb-3">
            <label>Upload Payment Slip (jpg, png, pdf):</label>
            <input type="file" class="form-control" name="payment_slip" required>
            @error('payment_slip')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
@endsection
