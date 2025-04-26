<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;

class StudentAvailableCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'approved')->latest()->get();

        return view('student.availablecourses', compact('courses'));
    }

    public function enroll($courseId)
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $student->courses()->attach($courseId);
            return redirect()->back()->with('success', 'You have successfully enrolled in the course!');
        }

        return redirect()->back()->with('error', 'Unable to enroll. Please try again.');
    }
}
