<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminCourseRequestController extends Controller
{
    public function index()
    {
        $requests = CourseRequest::with('course', 'student')->where('status', 'pending')->get();
        return view('admin.course_requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = CourseRequest::findOrFail($id);

        // Enroll the student in the course
        $student = Student::where('user_id', $request->student_id)->first();
        if ($student && !$student->courses->contains($request->course_id)) {
            $student->courses()->attach($request->course_id);
        }

        $request->status = 'approved';
        $request->save();

        return back()->with('success', 'Request approved and student enrolled.');
    }

    public function reject($id)
    {
        $request = CourseRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('success', 'Request rejected.');
    }

}
