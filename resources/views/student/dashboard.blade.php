@extends('student.layout')

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <style>
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .calendar-container {
            max-height: 450px;
        }

        iframe {
            border-radius: 10px;
        }

        h5 {
            font-weight: 600;
        }

        .notification-card {
            background-color: #f8f9fa;
            border-left: 5px solid #0d6efd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4em 0.6em;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #000;
        }

        .badge-info {
            background-color: #0dcaf0;
            color: #000;
        }
    </style>
@endpush

@section('content')
    <h2 class="mb-3">Welcome to your Student Dashboard</h2>
    <p class="text-muted">Here you can manage your learning experience with LearnNest.</p>

    <div class="row mt-4">
        <!-- Left Column: Course Progress -->
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5 class="mb-3">📊 Course Progress</h5>
                <canvas id="progressChart" height="200"></canvas>
            </div>
        </div>

        <!-- Right Column: Upcoming Events + Event List -->
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5 class="mb-3">📅 Upcoming Events</h5>
                <div id="calendar" class="mb-4"></div>

                <!-- Event List Below Calendar -->
                <h5 class="mb-3">📌 Event List</h5>
                <ul>
                    @foreach($events as $event)
                        <li>{{ $event->title }} - {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <!-- Lecture Recordings -->
        <div class="col-md-8 mb-4">
            <div class="card p-4">
                <h5 class="mb-3">🎥 Lecture Recordings</h5>
                <div class="row">
                    @forelse($lectures as $lecture)
                        <div class="col-md-4 mb-3">
                            <iframe width="100%" height="200" src="{{ $lecture->video_url }}"
                                    title="{{ $lecture->title }}" allowfullscreen></iframe>
                            <p class="mt-2">{{ $lecture->title }}</p>
                        </div>
                    @empty
                        <p>No lecture recordings available.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Notifications Column -->
        <div class="col-md-4 mb-4">
            <div class="card p-4">
                <h5 class="mb-3">🔔 Notifications</h5>

                <div class="notification-card">
                    <strong>DBMS Assignment Due</strong>
                    <span class="badge badge-danger ms-2">Urgent</span>
                    <p class="mb-0 text-muted">Submit by {{ date('F j, Y', strtotime('+3 days')) }}</p>
                </div>

                <div class="notification-card">
                    <strong>New Lecture Uploaded</strong>
                    <span class="badge badge-info ms-2">Info</span>
                    <p class="mb-0 text-muted">AI Lecture 2 is now available</p>
                </div>

                <div class="notification-card">
                    <strong>Web Quiz Announced</strong>
                    <span class="badge badge-warning ms-2">Reminder</span>
                    <p class="mb-0 text-muted">Scheduled for {{ date('F j, Y', strtotime('+5 days')) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart.js - Course Progress Chart
            new Chart(document.getElementById('progressChart'), {
                type: 'bar',
                data: {
                    labels: ['Math', 'DBMS', 'Web', 'AI'],
                    datasets: [{
                        label: 'Progress %',
                        data: [75, 60, 90, 80],
                        backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });

            // FullCalendar - Upcoming Events
            let events = @json($events);
            console.log(events); // Debug: check if events are passed

            let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                height: 400,
                events: events
            });

            calendar.render();
        });
    </script>
@endpush
