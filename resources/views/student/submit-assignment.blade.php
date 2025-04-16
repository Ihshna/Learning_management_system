@extends('student.layout')

@section('content')
    <h2>Submit Assignment: {{ $assignment->title }}</h2>

    <form action="{{ route('student.assignment.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="submission_file" class="form-label">Upload File</label>
            <input type="file" name="submission_file" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Additional Notes (optional)</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Assignment</button>
    </form>
@endsection

