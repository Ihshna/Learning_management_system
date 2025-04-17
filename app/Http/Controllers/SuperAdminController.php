<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function dashboard(){
        if(auth()->check()&& auth()->user()->role=='superadmin'){
            $courseCount = Course::count();
            $studentCount = User::where('role', 'student')->count();
            $adminCount = User::where('role', 'admin')->count();
            $pendingCourses = Course::where('status', 'pending')->count();

            return view('superadmin.dashboard', compact('courseCount', 'studentCount', 'adminCount', 'pendingCourses'));
        }

        return redirect()->route('login')->with('error', 'Unauthorized access');
    }

    


}

    

