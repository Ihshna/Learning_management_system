<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentDashboardController;

// Redirect root to login
Route::get('/', fn() => redirect('/login'));

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards for each role
Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

// Grouped Student Routes
Route::prefix('student')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    // My Courses
    Route::get('/my-courses', [StudentDashboardController::class, 'myCourses'])->name('student.mycourses');
    Route::delete('/courses/leave/{id}', [StudentDashboardController::class, 'leaveCourse'])->name('student.course.leave');
    Route::get('/course/details/{id}', [StudentDashboardController::class, 'courseDetails'])->name('student.course.details');

    // Available Courses
    Route::get('/available-courses', [StudentDashboardController::class, 'viewAvailableCourses'])->name('student.availableCourses');
    Route::post('/available-courses/join/{id}', [StudentDashboardController::class, 'joinCourse'])->name('student.course.join');

    // Assignments
    Route::get('/assignments', [StudentDashboardController::class, 'assignments'])->name('student.assignments');
    Route::get('/assignments/submit/{id}', [StudentDashboardController::class, 'submitAssignment'])->name('student.assignment.submit');
    Route::post('/assignments/submit/{id}', [StudentDashboardController::class, 'storeAssignment'])->name('student.assignment.store');

    // Submissions
    Route::get('/submissions', [StudentDashboardController::class, 'viewSubmissions'])->name('student.submissions');

    // Notifications
    Route::get('/notifications', [StudentDashboardController::class, 'notifications'])->name('student.notifications');

    // Profile
    Route::get('/profile', [StudentDashboardController::class, 'profile'])->name('student.profile');
});
