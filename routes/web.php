<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentDashboardController;

// Route for login and registration
Route::get('/', fn() => redirect('/login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards (for all roles)
Route::get('superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

// Routes for student, grouped with auth middleware
Route::prefix('student')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    
    // Courses
    Route::get('/my-courses', [StudentDashboardController::class, 'myCourses'])->name('student.mycourses');
    Route::get('/available-courses', [StudentDashboardController::class, 'viewAvailableCourses'])->name('student.availableCourses');
    Route::post('/available-courses/join/{course}', [StudentDashboardController::class, 'joinCourse'])->name('student.joinCourse');
    
    // Assignments
    Route::get('/assignments', [StudentDashboardController::class, 'assignments'])->name('student.assignments');
    Route::get('/assignments/submit/{id}', [StudentDashboardController::class, 'submitAssignment'])->name('student.assignment.submit');
    Route::post('/assignments/submit/{id}', [StudentDashboardController::class, 'storeAssignment'])->name('student.assignment.store');
    Route::get('/submissions', [StudentDashboardController::class, 'viewSubmissions'])->name('student.submissions');
    
    
});
