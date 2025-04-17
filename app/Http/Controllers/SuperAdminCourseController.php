<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class SuperAdminCourseController extends Controller
{
    public function pending()
{
    $pendingCourses = Course::where('status', 'pending')->get();
    return view('superadmin.courses.pending', compact('pendingCourses'));
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

    return redirect()->back()->with('success', 'Course rejected successfully.');
}

public function approved()
{
    $approvedCourses = Course::where('status', 'approved')->get();
    return view('superadmin.courses.approved', compact('approvedCourses'));
}
}
