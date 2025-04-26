<div class="accordion" id="studentSidebar">

    <!-- Dashboard -->
    <a href="{{ url('/student/dashboard') }}" class="d-block">Dashboard</a>

    <!-- My Courses -->
    <a href="{{ route('student.mycourses') }}" class="d-block"><i class="fas fa-book-open me-2"></i>My Courses</a>

    <!-- Assignments -->
    <a href="{{ route('student.assignments') }}" class="d-block text-white px-3 py-2">
    <i class="fas fa-tasks me-2"></i>My Assignments
</a>

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
