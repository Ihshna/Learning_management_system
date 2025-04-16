
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - LearnNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Student Panel</h4>
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('student.courses') }}">My Courses</a>
        <a href="{{ route('student.assignments') }}">My Assignments</a>
        <a href="{{ route('student.notifications') }}">Notifications</a>
        <a href="{{ route('student.profile') }}">Profile</a>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>




