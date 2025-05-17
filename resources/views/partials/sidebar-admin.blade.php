<div class="accordion" id="adminSidebar">

    <!-- Dashboard -->
    <a href="{{ url('/admin/dashboard') }}" class="d-block">Dashboard</a>

    <!-- Students -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#studentsMenu">
                Students
            </button>
        </h2>
        <div id="studentsMenu" class="accordion-collapse collapse" data-bs-parent="#adminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ route('admin.students.add') }}" class="d-block ps-4">Add Student</a>
                <a href="{{ route('admin.students.manage') }}" class="d-block ps-4">Manage Students</a>
            </div>
        </div>
    </div>

    <!-- Courses -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#coursesMenu">
                Courses
            </button>
        </h2>
        <div id="coursesMenu" class="accordion-collapse collapse" data-bs-parent="#adminSidebar">
            <div class="accordion-body p-0">
                
                <a href="{{ route('admin.courses.create') }}" class="d-block ps-4">Add Course</a>
                <a href="{{ route('admin.courses.manage') }}" class="d-block ps-4">Manage Courses</a>
                <a href="{{ route('admin.payments') }}" class="d-block ps-4">Payment Approvals</a> 

           
            </div>
        </div>
    </div>

    <!-- Assignments -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#assignmentsMenu">
                Assignments
            </button>
        </h2>
        <div id="assignmentsMenu" class="accordion-collapse collapse" data-bs-parent="#adminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ route('admin.assignments.create') }}" class="d-block ps-4">Create Assignment</a>
                <a href="{{ route('admin.assignments.manage') }}" class="d-block ps-4">Manage Assignments</a>
                <a href="{{ route('admin.assignments.submissions') }}" class="d-block ps-4">Submitted Assignments</a> <!-- New link added -->
            </div>
        </div>
    </div>

    <a href="{{ route('admin.lecture_recordings.index') }}" class="d-block text-white px-3 py-2">
        <i class="fas fa-video me-2"></i> Manage Lecture Recordings
    </a>

    <br><br><br><br><br><br><br><br><br><br>
    
    <!-- Bottom Logout Button -->
    <div class="p-3">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to logout?');">
            @csrf
            <button type="submit" class="btn text-black w-100 text-start" style="background-color:white; color:black;">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>

</div>
