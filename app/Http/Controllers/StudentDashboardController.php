<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\Event;
use App\Models\Lecture;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $lectures = Lecture::all();
        return view('student.dashboard', compact('events', 'lectures'));
    }
    
    // My Courses
    public function myCourses()
    {
    
        $student = Auth::user(); // Get the authenticated user (student)
        $courses = $student->courses ?: collect(); // Get courses the student is enrolled in

    return view('student.my_courses', compact('courses')); // Pass courses to the view
    }


    // Available Courses (to join)
    public function viewAvailableCourses()
    {
        $student = auth()->user();
        $enrolledCourseIds = $student->courses->pluck('id')->toArray();
    
        $courses = Course::whereNotIn('id', $enrolledCourseIds)
                         ->latest()
                         ->get();
    
        return view('student.available_courses', compact('courses'));
    }
    
    // Join Course
    public function joinCourse($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);

    // Prevent duplicate enrollments
    if (!$user->courses->contains($id)) {
        $user->courses()->attach($id);
    }

    return redirect()->route('student.mycourses')->with('success', 'You have successfully joined the course!');
    }

    public function leaveCourse($id)
{
    $user = Auth::user();
    $course = Course::findOrFail($id);

    // Detach course from the pivot table
    $user->courses()->detach($course->id);

    return redirect()->route('student.mycourses')->with('success', 'You have successfully left the course!');
}
 
    
    // Assignments
    public function assignments()
    {
        $student = auth()->user();
        $assignments = [];
    
        foreach ($student->courses as $course) {
            foreach ($course->assignments as $assignment) {
                $assignments[] = $assignment;
            }
        }
        return view('student.assignments', compact('assignments'));
    }

    // Submit Assignment
    public function submitAssignment($id)
{
    $assignment = Assignment::findOrFail($id);
    return view('student.submit-assignment', compact('assignment'));
}

public function storeAssignment(Request $request, $id)
{
    $request->validate([
        'submission_file' => 'required|mimes:pdf,docx,zip|max:20480',
        'notes' => 'nullable|string',
    ]);

    // Store the uploaded file
    $filePath = $request->file('submission_file')->store('submissions', 'public');

    // Create a new assignment submission record
    AssignmentSubmission::create([
        'assignment_id' => $id,
        'student_id' => auth()->id(),
        'submission_file' => $filePath,
        'notes' => $request->notes,
        'submitted_at' => now(),
    ]);

    // Redirect to the submissions page
    return redirect()->route('student.submissions')->with('success', 'Assignment submitted successfully!');
}


    // View Submissions
    public function viewSubmissions()
    { 
        $submissions = AssignmentSubmission::with('assignment')
                    ->where('student_id', auth()->id())
                    ->latest()
                    ->get();

        return view('student.view-submissions', compact('submissions'));
    }

    // Notifications
    public function notifications()
    {
        return view('student.notifications');
    }

    // Profile
    public function profile()
    {
        return view('student.profile');
    }
}
