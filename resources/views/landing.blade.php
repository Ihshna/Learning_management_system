<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LearnNest - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .hero-section {
      background: url('https://source.unsplash.com/1600x900/?education') no-repeat center center/cover;
      height: 80vh;
      color: white;
      position: relative;
    }

    .hero-overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
    }

    .hero-content {
      position: absolute;
      top: 50%; left: 10%;
      transform: translateY(-50%);
      z-index: 10;
    }

    .auth-buttons {
      position: absolute;
      top: 20px; right: 30px;
      z-index: 20;
    }

    .course-card:hover {
      transform: scale(1.03);
      transition: all 0.3s ease-in-out;
    }

    @keyframes slideInLeft {
  0% {
    opacity: 0;
    transform: translateX(-50px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.slide-in-left {
  animation: slideInLeft 1s ease-out forwards;
}
  </style>
</head>
<body>

  <!-- Hero Section -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{ asset('images/head.jpg') }}" class="d-block w-100" style="height: 100vh; object-fit: cover;">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-end h-100 pe-5">
                <h1 class="display-3 text-white fw-bold">Welcome to LearnNest</h1>
                <p class="lead text-white">Learn. Grow. Achieve.</p>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                    
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/about-learnnest.jpg') }}" class="d-block w-100" style="height: 100vh; object-fit: cover;">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-end h-100 pe-5">
                <h1 class="display-3 text-white fw-bold">Discover Quality Courses</h1>
                <p class="lead text-white">Empower your future with the best content</p>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                </div>
            </div>
        </div>

    </div>
</div>

  <!-- About LearnNest Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('images/about-learnnest.jpg') }}" alt="About LearnNest" class="img-fluid rounded shadow slide-in-left">
      </div>
      <div class="col-md-6">
        <h2>About LearnNest</h2>
        <p class="lead">
          LearnNest is your all-in-one learning management system designed to simplify online education. We empower students, teachers, and institutions with powerful tools to manage courses, assignments, and learning progress seamlessly.
        </p>
        <p>
          Whether you're here to learn new skills or to manage educational content, LearnNest offers a user-friendly experience, real-time course tracking, feedback systems, and much more—all under one digital roof.
        </p>
        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Explore Now</a>
      </div>
    </div>
  </div>
</section>

  <!-- Courses Section -->
  <section id="courses" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Available Courses</h2>
      <div class="row">
        @forelse($courses as $course)
          <div class="col-md-4 mb-4">
            <div class="card course-card shadow">
              <div class="card-body">
                <h5 class="card-title">{{ $course->title }}</h5>
                <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                <a href="#" class="btn btn-outline-primary btn-sm">View Course</a>
              </div>
            </div>
          </div>
        @empty
          <p class="text-center">No approved courses found.</p>
        @endforelse
      </div>
    </div>
  </section>

  <section class="py-5 bg-light" id="feedback">
    <div class="container">
        <h2 class="mb-4">We Value Your Feedback</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Your Feedback</label>
                <textarea name="message" rows="4" class="form-control" required></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Submit Feedback</button>
        </form>
    </div>
</section>

  <footer class="bg-dark text-white text-center py-4">
    <p>&copy; {{ date('Y') }} LearnNest. All rights reserved.</p>
  </footer>

</body>
</html>