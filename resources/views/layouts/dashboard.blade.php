<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #2c3e50; color: white; }
        .sidebar a { color: white; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover { background-color: #1abc9c; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h3 class="text-center py-3">Dashboard</h3>
            @php $role = Auth::user()->role; @endphp

            @if($role == 'superadmin')
                @include('partials.sidebar-superadmin')
            @elseif($role == 'admin')
                @include('partials.sidebar-admin')
            @elseif($role == 'student')
                @include('partials.sidebar-student')
            @endif
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>