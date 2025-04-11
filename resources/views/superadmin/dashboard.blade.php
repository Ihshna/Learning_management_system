@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-white mb-4">Welcome, Super Admin!</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    Total Admins
                    <h4>{{ $adminCount }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    Pending Courses
                    <h4>{{ $pendingCourses }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    Approved Courses
                    <h4>{{ $approvedCourses }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    Rejected Courses
                    <h4>{{ $rejectedCourses }}</h4>
                </div>
            </div>
        </div>
    </div>

 <!-- Optional Chart Section -->
 <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Course Approval Status</h5>
                    <canvas id="courseChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

