@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-white mb-4">Course Requests</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Pending -->
    <h5 class="text-warning">Pending Requests</h5>
    <table class="table table-bordered table-striped table-dark mb-5">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Requested On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pending as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->created_at->format('d M Y') }}</td>
                <td>
                    <form method="POST" action="{{ url('/superadmin/courses/'.$course->id.'/approve') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                    <form method="POST" action="{{ url('/superadmin/courses/'.$course->id.'/reject') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Approved -->
    <h5 class="text-success">Approved Courses</h5>
    <table class="table table-bordered table-striped table-dark mb-5">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Approved On</th>
            </tr>
        </thead>
        <tbody>
        @foreach($approved as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->updated_at->format('d M Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Rejected -->
    <h5 class="text-danger">Rejected Courses</h5>
    <table class="table table-bordered table-striped table-dark">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Rejected On</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rejected as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->updated_at->format('d M Y') }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
</div>
@endsection
