<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class SuperAdminCourseController extends Controller
{
    public function pending()
    {
        $courses = Course::where('status', 'pending')->with('creator')->get();
        return view('superadmin.courses.pending', compact('courses'));
    }

    public function approve($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'approved';
        $course->save();

        return redirect()->back()->with('success', 'Course approved successfully.');
    }

    public function reject($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'rejected';
        $course->save();

        return redirect()->back()->with('error', 'Course rejected.');
    }
}

