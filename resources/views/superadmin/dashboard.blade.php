@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Welcome to Super Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Courses</h5>
                    <p class="card-text">{{ $courseCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text">{{ $studentCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text">{{ $adminCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Approvals</h5>
                    <p class="card-text">{{ $pendingCourses }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5">Students Per Course </h3>
    <div class="d-flex">
        <div style="width: 85%; height: 400px;">
            <canvas id="studentsCourseChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const courseNames = @json($courses->pluck('title'));
    const studentCounts = @json($courses->pluck('students_count'));

    const ctx = document.getElementById('studentsCourseChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: courseNames,
            datasets: [{
                label: 'Number of Students',
                data: studentCounts,
                backgroundColor: 'grey',
                borderColor: '#3490dc',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'x',
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Number of Students'
                    }
                },
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0,
                        align: 'center',
                        padding: 15,
                        font: {
                            size: 10
                        }
                    },
                    title: {
                        display: true,
                        text: 'Course Name'
                    },
                    

                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true
                }
            }
        }
    });
</script>
@endsection
