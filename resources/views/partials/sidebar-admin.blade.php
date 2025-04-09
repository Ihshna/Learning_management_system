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
                <a href="{{ url('/admin/add-student') }}" class="d-block ps-4">Add Student</a>
                <a href="{{ url('/admin/manage-students') }}" class="d-block ps-4">Manage Students</a>
            </div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#teachersMenu">
                Teachers
            </button>
        </h2>
        <div id="teachersMenu" class="accordion-collapse collapse" data-bs-parent="#adminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ url('/admin/add-teacher') }}" class="d-block ps-4">Add Teacher</a>
                <a href="{{ url('/admin/manage-teachers') }}" class="d-block ps-4">Manage Teachers</a>
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
                <a href="{{ url('/admin/add-course') }}" class="d-block ps-4">Add Course</a>
                <a href="{{ url('/admin/manage-courses') }}" class="d-block ps-4">Manage Courses</a>
                <a href="{{ url('/admin/send-approval') }}" class="d-block ps-4">Send for Approval</a>
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
                <a href="{{ url('/admin/create-assignment') }}" class="d-block ps-4">Create Assignment</a>
                <a href="{{ url('/admin/manage-assignments') }}" class="d-block ps-4">Manage Assignments</a>
            </div>
        </div>
    </div>

</div>