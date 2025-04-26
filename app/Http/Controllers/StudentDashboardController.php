<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\LectureRecording;
use App\Models\Event;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $projects = 4; // static or from DB if needed
        $courses = Course::where('status', 'approved')->count();
        $members = User::where('role', 'student')->count();

        $recordings = LectureRecording::latest()->take(3)->get();
        $events = Event::orderBy('event_date')->take(4)->get();

        return view('student.dashboard', compact('projects', 'courses', 'members', 'recordings', 'events'));
    }
}