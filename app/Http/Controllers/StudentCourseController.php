<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseRequest;


class StudentCourseController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $courses = $student
            ? $student->courses()->withPivot('created_at')->get()
            : collect();       
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

    public function requestCourse($courseId)
{
    $userId = auth()->id();
    
    $exists = CourseRequest::where('student_id', $userId)
        ->where('course_id', $courseId)
        ->first();

    if ($exists) {
        return back()->with('status', 'You already requested to join this course.');
    }

    CourseRequest::create([
        'student_id' => $userId,
        'course_id' => $courseId,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Join request sent. Awaiting admin approval.');
}



}