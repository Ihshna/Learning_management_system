<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AddAdminController;
use App\Http\Controllers\SuperAdminCourseController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentAvailableCourseController;
use App\Http\Controllers\StudentAssignmentController;
use App\Http\Controllers\AdminLectureRecordingController;
use Illuminate\Support\Facades\Auth;


//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

//Route::get('/', fn() => redirect('/login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards (ensure only authenticated users can access)
Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Add students
Route::get('/admin/students/add', [AdminStudentController::class, 'create'])->name('admin.students.add');
Route::post('/admin/students/store', [AdminStudentController::class, 'store'])->name('admin.students.store');

//manage students
Route::get('/admin/students/manage', [AdminStudentController::class, 'index'])->name('admin.students.manage');
Route::get('/admin/students/edit/{id}', [AdminStudentController::class, 'edit'])->name('admin.students.edit');
Route::post('/admin/students/update/{id}', [AdminStudentController::class, 'update'])->name('admin.students.update');
Route::get('/admin/students/delete/{id}', [AdminStudentController::class, 'delete'])->name('admin.students.delete');

//Manage courses
Route::prefix('admin')->group(function () {
    Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses/store', [AdminCourseController::class, 'store'])->name('admin.courses.store');
    Route::get('courses/manage',[AdminCourseController::class, 'manage'])->name('admin.courses.manage');
    Route::get('/courses/edit/{id}', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
Route::put('/courses/update/{id}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
Route::delete('/courses/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.courses.delete');
});

// Admin - Assignments
Route::get('/admin/assignments/create', [AssignmentController::class, 'create'])->name('admin.assignments.create');
Route::post('/admin/assignments/store', [AssignmentController::class, 'store'])->name('admin.assignments.store');
Route::get('/admin/assignments/manage', [AssignmentController::class, 'index'])->name('admin.assignments.manage');
Route::get('/admin/assignments/edit/{id}', [AssignmentController::class, 'edit'])->name('admin.assignments.edit');
Route::post('/admin/assignments/update/{id}', [AssignmentController::class, 'update'])->name('admin.assignments.update');
Route::get('/admin/assignments/delete/{id}', [AssignmentController::class, 'delete'])->name('admin.assignments.delete');
Route::get('/admin/assignments/submissions', [AssignmentController::class, 'viewSubmissions'])->name('admin.assignments.submissions');



//Feedback
Route::post('/feedback',[FeedbackController::class,'store'])->name('feedback.store');

//Super -admin
Route::get('/superadmin/dashboard',[SuperAdminController::class,'dashboard'])->name('superadmin.dashboard');
Route::get('/superadmin/admins/add', [AddAdminController::class, 'create'])->name('superadmin.admins.create');
Route::post('/superadmin/admins/store', [AddAdminController::class, 'store'])->name('superadmin.admins.store');

// Manage Admins
Route::get('/superadmin/admins/manage', [AddAdminController::class, 'index'])->name('superadmin.admins.manage');

// Edit Admin
Route::get('/superadmin/admins/edit/{id}', [AddAdminController::class, 'edit'])->name('superadmin.admins.edit');
Route::post('/superadmin/admins/update/{id}', [AddAdminController::class, 'update'])->name('superadmin.admins.update');

// Delete Admin
Route::delete('/superadmin/admins/delete/{id}', [AddAdminController::class, 'destroy'])->name('superadmin.admins.destroy');

//Approval course
Route::get('/superadmin/courses/pending', [SuperAdminCourseController::class, 'pending'])->name('superadmin.courses.pending');
Route::post('/superadmin/courses/approve/{id}', [SuperAdminCourseController::class, 'approve'])->name('superadmin.courses.approve');
Route::post('/superadmin/courses/reject/{id}', [SuperAdminCourseController::class, 'reject'])->name('superadmin.courses.reject');

//Approved Courses
Route::get('/superadmin/courses/approved', [SuperAdminCourseController::class, 'approved'])->name('superadmin.courses.approved');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to landing page
})->name('logout');

//Student
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

Route::get('/student/my-courses', [StudentCourseController::class, 'index'])->name('student.mycourses');
Route::get('/student/course/{id}', [StudentCourseController::class, 'show'])->name('student.course.show');
Route::post('/student/course/leave/{course}', [StudentCourseController::class, 'leave'])->name('student.course.leave');

Route::get('/student/available-courses', [StudentAvailableCourseController::class, 'index'])->name('student.availablecourses');
Route::post('/student/available-courses/enroll/{course}', [StudentAvailableCourseController::class, 'enroll'])->name('student.availablecourses.enroll');

//Assignments
Route::get('/student/my-assignments', [StudentAssignmentController::class, 'index'])->name('student.assignments');
Route::get('/student/submit-assignment/{assignment}', [StudentAssignmentController::class, 'submit'])->name('student.assignment.submit');
Route::post('/student/submit-assignment/{assignment}', [StudentAssignmentController::class, 'storeSubmission'])->name('student.assignment.store');
Route::get('/student/submitted-assignments', [StudentAssignmentController::class, 'submittedAssignments'])->name('student.assignments.submitted');

// Admin - Lecture Recordings
Route::get('/admin/lecture-recordings', [AdminLectureRecordingController::class, 'index'])->name('admin.lecture_recordings.index');
Route::get('/admin/lecture-recordings/create', [AdminLectureRecordingController::class, 'create'])->name('admin.lecture_recordings.create');
Route::post('/admin/lecture-recordings/store', [AdminLectureRecordingController::class, 'store'])->name('admin.lecture_recordings.store');
Route::delete('/admin/lecture-recordings/{id}', [AdminLectureRecordingController::class, 'destroy'])->name('admin.lecture-recordings.destroy');

//Student Approval/Rejection
Route::get('/superadmin/students/pending', [SuperAdminController::class, 'pendingStudents'])->name('superadmin.students.pending');
Route::post('/superadmin/students/{id}/approve', [SuperAdminController::class, 'approveStudent'])->name('superadmin.students.approve');
Route::post('/superadmin/students/{id}/reject', [SuperAdminController::class, 'rejectStudent'])->name('superadmin.students.reject');
//Approved students
Route::get('/superadmin/students/approved', [SuperAdminController::class, 'approvedStudents'])->name('superadmin.students.approved');