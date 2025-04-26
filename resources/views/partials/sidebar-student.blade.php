<div class="accordion" id="studentSidebar">

    <!-- Dashboard -->
    <a href="{{ url('/student/dashboard') }}" class="d-block">Dashboard</a>

    <!-- My Courses -->
    <a href="{{ route('student.mycourses') }}" class="d-block"><i class="fas fa-book-open me-2"></i>My Courses</a>

    <!-- Assignments -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#assignmentsMenu">
                Assignments
            </button>
        </h2>
        <div id="assignmentsMenu" class="accordion-collapse collapse" data-bs-parent="#studentSidebar">
            <div class="accordion-body p-0">
                <a href="{{ url('/student/submit-assignment') }}" class="d-block ps-4">Submit Assignments</a>
                <a href="{{ url('/student/view-submitted') }}" class="d-block ps-4">View Submitted</a>
            </div>
        </div>
    </div>

    <!-- Grades -->
    <a href="{{  route('student.availablecourses') }}" class="d-block"><i class="fas fa-graduation-cap me-2"></i>Available Courses</a>

    <!-- Announcements -->
    <a href="{{ url('/student/announcements') }}" class="d-block">View Announcements</a>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- Bottom Logout Button -->
<div class="p-3">
        <form action="{{ route('logout') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to logout?');">
            @csrf
            <button type="submit" class="btn text-black w-100 text-start" style="background-color:white; color:black;">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>

</div>
