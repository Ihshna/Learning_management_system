<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\LectureRecording;
use App\Models\Event;
use App\Models\Assignment;
use App\Models\LiveClass;

class StudentDashboardController extends Controller
{
   public function index(Request $request)
{
    $projects = 4;
    $coursesCount = Course::where('status', 'approved')->count();
    $members = User::where('role', 'student')->count();

    $course_id = $request->input('course_id');
    $courseList = Course::where('status', 'approved')->get();

    $recordings = LectureRecording::when($course_id, function ($query, $course_id) {
        return $query->where('course_id', $course_id);
    })->latest()->take(3)->get();

    $events = Event::orderBy('event_date')->take(4)->get();

    $assignments = Assignment::where('due_date', '>=', now())
        ->orderBy('due_date')
        ->take(5)
        ->get();

    // ✅ Add this line to fix the error
    $liveClasses = LiveClass::where('start_time', '>=', now())
                            ->orderBy('start_time')
                            ->get();

    return view('student.dashboard', compact(
        'projects',
        'coursesCount',
        'members',
        'recordings',
        'events',
        'assignments',
        'courseList',
        'course_id',
        'liveClasses' // ✅ Include it here too
    ));
}



}
