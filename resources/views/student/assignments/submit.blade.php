@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4">Submit Assignment</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm p-4">
        <form method="POST" action="{{ route('student.assignment.store', $assignment->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Assignment Title:</label>
                <input type="text" class="form-control" value="{{ $assignment->title }}" disabled>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Upload File (PDF, DOC, DOCX):</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Additional Note:</label>
                <textarea name="note" id="note" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit Assignment</button>
        </form>
    </div>

</div>
@endsection
