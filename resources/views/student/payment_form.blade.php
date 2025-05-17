@extends('layouts.dashboard')
@section('content')
<div class="container py-4">
    <h3>Submit Payment for {{ $course->title }}</h3>
     @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <form method="POST" action="{{ route('student.course.payment.submit', $course->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Student Name:</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
        </div>

        <div class="alert alert-info">
            <strong>Note:</strong> Please transfer the payment to:
            <ul class="mt-2">
                <li><strong>Account Number:</strong> 8074223594</li>
                <li><strong>Beneficiery Name:</strong> LearnNest</li>
                <li><strong>Bank:</strong> People's Bank</li>
            </ul>
             After payment,upload your deposit slip or screenshot below.
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
