@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Pending Payment Approvals</h3>

    @if($payments->isEmpty())
        <div class="alert alert-info">No pending payments found.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Uploaded At</th>
                    <th>Slip</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->student->name }}</td>
                    <td>{{ $payment->course->title }}</td>
                    <td>{{ $payment->created_at}}</td>
                    <td>
                        <a href="{{ asset($payment->payment_slip) }}" target="_blank">View Slip</a>

                    </td>
                    <td>
    @if($payment->status === 'pending')
        <form method="POST" action="{{ route('admin.payment.approve', $payment->id) }}">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Approve</button>
        </form>
        <form method="POST" action="{{ route('admin.payment.reject', $payment->id) }}" class="mt-1">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
        </form>
    @else
        <span class="badge bg-{{ $payment->status === 'approved' ? 'success' : 'danger' }}">
            {{ ucfirst($payment->status) }}
        </span>
    @endif
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
