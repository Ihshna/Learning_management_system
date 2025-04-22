
@extends('student.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Submit Assignment</h2>

    <form action="{{ route('student.assignment.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="submission_file">Submission File</label>
            <input type="file" name="submission_file" id="submission_file" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="notes">Additional Notes (Optional)</label>
            <textarea name="notes" id="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Submit Assignment</button>
    </form>
</div>
@endsection
