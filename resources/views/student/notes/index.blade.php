@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <h3 class="mb-4 text-primary">Lecture Notes for {{ $course->title }}</h3>

    @if($notes->isEmpty())
        <div class="alert alert-info">No lecture notes available yet for this course.</div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Lecture Number</th>
                    <th>Title</th>
                    <th>PDF</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $note)
                <tr>
                    <td>{{ $note->lecture_number }}</td>
                    <td>{{ $note->title }}</td>
                    <td>
                        <a href="{{ route('student.course.notes.view', $note->id) }}" class="btn btn-sm btn-outline-primary">
                            View PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
