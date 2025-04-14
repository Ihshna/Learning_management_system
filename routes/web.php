<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\SuperAdminCourseController;


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

Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');

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

// Super Admin Routes
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/admins/add_admin', [SuperAdminController::class, 'addAdminForm'])->name('superadmin.addAdmin');
    Route::post('/superadmin/admins/store', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.storeAdmin');
    Route::get('/superadmin/admins/manage', [SuperAdminController::class, 'manageAdmins'])->name('superadmin.manageAdmins');
});

Route::get('/superadmin/add_admin', [SuperAdminController::class, 'showAddAdmin']);

Route::get('/superadmin/manage_admins', [SuperAdminController::class, 'manageAdmins'])->name('superadmin.manageAdmins');


Route::post('/superadmin/delete_admin/{id}', [SuperAdminController::class, 'deleteAdmin'])->name('admin.delete');


Route::get('/superadmin/pending-requests', [SuperAdminController::class, 'pendingRequests'])->name('superadmin.pendingRequests');
Route::get('/superadmin/approved-courses', [SuperAdminController::class, 'approvedCourses'])->name('superadmin.approvedCourses');
Route::get('/superadmin/rejected-courses', [SuperAdminController::class, 'rejectedCourses'])->name('superadmin.rejectedCourses');



Route::post('/superadmin/admins/add', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.storeAdmin');

// Show the edit form
Route::get('/superadmin/admins/edit/{id}', [SuperAdminController::class, 'editAdmin'])->name('superadmin.editAdmin');

// Handle the update
Route::post('/superadmin/admins/update/{id}', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.updateAdmin');


Route::prefix('superadmin')->group(function () {
    Route::get('courses/pending', [SuperAdminCourseController::class, 'pending'])->name('superadmin.courses.pending');
    Route::post('courses/{id}/approve', [SuperAdminCourseController::class, 'approve'])->name('superadmin.courses.approve');
    Route::post('courses/{id}/reject', [SuperAdminCourseController::class, 'reject'])->name('superadmin.courses.reject');
});



// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

