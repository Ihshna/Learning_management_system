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
  <div class="hero-section">
    <div class="hero-overlay"></div>

    <div class="auth-buttons">
      <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
      <a href="{{ route('register') }}" class="btn btn-light">Register</a>
    </div>

    <div class="hero-content">
      <h1 class="display-3 fw-bold">Welcome to LearnNest</h1>
      <p class="lead">Your ultimate e-learning platform. Explore a variety of courses and start learning now!</p>
      <a href="#courses" class="btn btn-primary btn-lg mt-3">Explore Courses</a>
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

  <footer class="bg-dark text-white text-center py-4">
    <p>&copy; {{ date('Y') }} LearnNest. All rights reserved.</p>
  </footer>

</body>
</html>