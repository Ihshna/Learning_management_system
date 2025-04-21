<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\Event;
use App\Models\Lecture;
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
        $student = auth()->user();
        $courses = $student->courses; // eager load courses associated with the student
        return view('student.my_courses', compact('courses'));
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

        return redirect()->back()->with('success', 'You have successfully joined the course!');
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

    // Store Assignment Submission
    public function storeAssignment(Request $request, $id)
    {
        $request->validate([
            'submission_file' => 'required|mimes:pdf,docx,zip|max:20480',
            'notes' => 'nullable|string',
        ]);
    
        $filePath = $request->file('submission_file')->store('submissions', 'public');
    
        AssignmentSubmission::create([
            'assignment_id' => $id,
            'student_id' => auth()->id(),
            'submission_file' => $filePath,
            'notes' => $request->notes,
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.assignments')->with('success', 'Assignment submitted successfully!');
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
