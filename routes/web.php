<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


//Route::get('/', function () {
  //  return view('welcome');
//});
Route::get('/', fn() => redirect('/login'));

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Super Admin Dashboard
Route::middleware(['auth', 'role:super_admin'])->get('/super-admin/dashboard', function () {
    return view('dashboard.super_admin');
});

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('dashboard.admin');
});

// Student Dashboard
Route::middleware(['auth', 'role:student'])->get('/student/dashboard', function () {
    return view('dashboard.student');
});