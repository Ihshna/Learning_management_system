<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;


class CourseRequestController extends Controller
{
    public function index()
{
    $pending = Course::where('status', 'pending')->get();
    $approved = Course::where('status', 'approved')->get();
    $rejected = Course::where('status', 'rejected')->get();

    return view('superadmin.course_requests', compact('pending', 'approved', 'rejected'));
}

public function approve($id)
{
    $course = Course::findOrFail($id);
    $course->update(['status' => 'approved']);
    return back()->with('success', 'Course approved.');
}

public function reject($id)
{
    $course = Course::findOrFail($id);
    $course->update(['status' => 'rejected']);
    return back()->with('success', 'Course rejected.');
}



    //
}
