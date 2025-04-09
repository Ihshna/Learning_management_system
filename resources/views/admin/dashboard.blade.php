@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="text-black mb-4">Admin Dashboard</h3>

    <!-- Total Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h2>{{ $totalStudents ?? 0 }}</h2>
                </div>
            </div>
        </div>


        <div class="col-md-3 mb-3">
        <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <h2>{{ $totalCourses ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5>Total Assignments</h5>
                    <h2>{{ $totalAssignments ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <h4 class="text-blue mt-5">Student Registrations - Last 12 Months</h4>
    <canvas id="studentChart" height="100"></canvas>
</div>

<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('studentChart').getContext('2d');
    const studentChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Students',
                data: @json($studentCounts),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection

