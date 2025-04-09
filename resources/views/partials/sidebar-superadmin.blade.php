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
                <a href="{{ url('/superadmin/add-admin') }}" class="d-block ps-4">Add Admin</a>
                <a href="{{ url('/superadmin/manage-admins') }}" class="d-block ps-4">Manage Admins</a>
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
                <a href="{{ url('/superadmin/pending-requests') }}" class="d-block ps-4">Pending Requests</a>
                <a href="{{ url('/superadmin/approved-courses') }}" class="d-block ps-4">Approved Courses</a>
                <a href="{{ url('/superadmin/rejected-courses') }}" class="d-block ps-4">Rejected Courses</a>
            </div>
        </div>
    </div>

</div>