<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\CourseRequestController;

//Route::get('/', function () {
    //return view('welcome');
//});


Route::get('/', fn() => redirect('/login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards (ensure only authenticated users can access)
Route::get('superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

//create super admin dashboard
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard', [
        'adminCount' => 4,
        'pendingCourses' => 3,
        'approvedCourses' => 8,
        'rejectedCourses' => 1,
    ]);
});

//Route Setup
Route::get('/superadmin/admins/create', [AdminManagementController::class, 'create']);
Route::post('/superadmin/admins', [AdminManagementController::class, 'store']);

// Add Routes
Route::get('/superadmin/admins', [AdminManagementController::class, 'index']);
Route::get('/superadmin/admins/{id}/edit', [AdminManagementController::class, 'edit']);
Route::post('/superadmin/admins/{id}/update', [AdminManagementController::class, 'update']);
Route::delete('/superadmin/admins/{id}', [AdminManagementController::class, 'destroy']);

//Define Routes
Route::get('/superadmin/courses/requests', [CourseRequestController::class, 'index']);
Route::post('/superadmin/courses/{id}/approve', [CourseRequestController::class, 'approve']);
Route::post('/superadmin/courses/{id}/reject', [CourseRequestController::class, 'reject']);





// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

