<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;

class StudentCourseController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            
            $courses = $student->courses ?? collect();
        } else {
            $courses = collect(); 
        }

        return view('student.mycourses', compact('courses'));
    }
}