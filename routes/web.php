<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminCourseController;
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

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

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