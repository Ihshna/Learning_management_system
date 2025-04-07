<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [LoginController::class,'showLogin'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::get('/register', [RegisterController::class,'showRegister'])->name('register');
Route::post('/register',[RegisterController::class,'register']);

Route::get('/logout', [LoginController::class,'logout'])->name('logout');

//dashboards
Route::middleware(['auth','role:super_admin'])->get('/super-admin/dashboard',fn() => view('dashboard.superadmin'));
Route::middleware(['auth','role:admin'])->get('/admin/dashboard',fn() => view('dashboard.admin'));
Route::middleware(['auth','role:student'])->get('/student/dashboard',fn() => view('dashboard.student'));

Route::get('/', function () {
    return view('welcome');
});
