<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1abc9c;
        }

        .accordion-button::after {
    filter: invert(1); /* Makes arrow icon white */
}
     


.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0,0,0,0.2);
}

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <div class="sidebar-logo p-4">
                <img src="{{asset('images/logo.jpeg') }}" class="rounded-circle d-block mx-auto" alt="Logo"
                 style="width:100px; height:100px; object-fit: cover;">
</div>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!--chart.js-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>