<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentCourseController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $courses = $student->courses()->withPivot('created_at')->get();
        } else {
            $courses = collect();
        }

        return view('student.mycourses', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('student.coursedetails', compact('course'));
    }

    public function leave($courseId)
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $student->courses()->detach($courseId);
            return redirect()->back()->with('success', 'You have successfully left the course.');
        }

        return redirect()->back()->with('error', 'Unable to leave the course.');
    }
}