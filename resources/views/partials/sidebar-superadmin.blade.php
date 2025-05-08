<div class="accordion" id="superadminSidebar">

    <!-- Dashboard -->
    <a href="{{ url('/superadmin/dashboard') }}" class="d-block">Dashboard</a>

    <!-- Overview Admins -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#adminsMenu">
                Overview Admins
            </button>
        </h2>
        <div id="adminsMenu" class="accordion-collapse collapse" data-bs-parent="#superadminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ route('superadmin.admins.create') }}" class="d-block ps-4">Add Admin</a>
                <a href="{{ route('superadmin.admins.manage') }}" class="d-block ps-4">Manage Admins</a>
            </div>
        </div>
    </div>

    <!-- Course Requests -->
    <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#courseRequestsMenu">
                Course Requests
            </button>
        </h2>
        <div id="courseRequestsMenu" class="accordion-collapse collapse" data-bs-parent="#superadminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ route('superadmin.courses.pending') }}" class="d-block ps-4">Pending Requests</a>
                <a href="{{ route('superadmin.courses.approved') }}" class="d-block ps-4">Approved Courses</a>
            </div>
        </div>
    </div>
   
     <!-- Student Requests -->
     <div class="accordion-item bg-transparent border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-transparent text-white" type="button" data-bs-toggle="collapse" data-bs-target="#studentRequestMenu">
                Student Requests
            </button>
        </h2>
        <div id="studentRequestMenu" class="accordion-collapse collapse" data-bs-parent="#superadminSidebar">
            <div class="accordion-body p-0">
                <a href="{{ route('superadmin.students.pending') }}" class="d-block ps-4">Pending Requests</a>
                <a href="{{ route('superadmin.students.approved') }}" class="d-block ps-4">Approved Students</a>
                
            </div>
        </div>
</div>
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


