<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCourseRequestController extends Controller
{
    public function index()
    {
        $requests = CourseRequest::with('course', 'student')->where('status', 'pending')->get();
        return view('admin.course_requests.index', compact('requests'));
    }

    public function approve($id)
{
    $request = CourseRequest::findOrFail($id); // student_id = users.id

    
    DB::table('course_student')->updateOrInsert([
        'student_id' => $request->student_id, 
        'course_id'  => $request->course_id
    ], [
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $request->status = 'approved';
    $request->save();

    return back()->with('success', 'Student enrolled successfully.');
}


    public function reject($id)
    {
        $request = CourseRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return back()->with('success', 'Request rejected.');
    }

}
