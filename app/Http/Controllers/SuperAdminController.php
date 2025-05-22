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

    public function dashboard()
{
    if(auth()->check() && auth()->user()->role == 'superadmin'){
        $courseCount = Course::count();
        $adminCount = User::where('role', 'admin')->count();
        $pendingCourses = Course::where('status', 'pending')->count();

        // Get all courses with student counts
        $courses = Course::withCount(['students' => function ($query) {
            $query->where('role', 'student');
        }])->get();

        // Optional: total students count if still needed
        $studentCount = User::where('role', 'student')->count();

        return view('superadmin.dashboard', compact('courseCount', 'adminCount', 'pendingCourses', 'courses', 'studentCount'));
    }

    return redirect()->route('login')->with('error', 'Unauthorized access');
}


    
    public function pendingStudents()
       {
        $students = User::where('role', 'student')->where('status', 'pending')->get();
         return view('superadmin.students.pending', compact('students'));
      }

    public function approveStudent($id)
      {
         $student = User::findOrFail($id);
         $student->status = 'approved';
         $student->save();

    return back()->with('success', 'Student approved successfully.');
    }

     public function rejectStudent($id)
    {
       $student = User::findOrFail($id);
       $student->status = 'rejected';
       $student->save();

    return back()->with('success', 'Student rejected.');
    }

    public function approvedStudents()
    {
    $students = User::where('role', 'student')
                    ->where('status', 'approved')
                    ->latest()
                    ->get();

    return view('superadmin.students.approved', compact('students'));
    }

}

    

