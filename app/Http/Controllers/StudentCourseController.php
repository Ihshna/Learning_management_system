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
        $user = auth()->user();

        $courses = $user->enrolledCourses()->withPivot('created_at')->get();

        return view('student.mycourses', compact('courses'));

    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('student.coursedetails', compact('course'));
    }

    public function leave($courseId)
    {
        $user = auth()->user();

    // Remove from pivot table
    $user->enrolledCourses()->detach($courseId);

    
    CourseRequest::where('student_id', $user->id)
        ->where('course_id', $courseId)
        ->where('status', 'approved')
        ->delete();

    return redirect()->back()->with('success', 'You have successfully left the course.');

    
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