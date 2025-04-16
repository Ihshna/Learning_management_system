<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Storage;


class StudentDashboardController extends Controller
{
    public function index() {
        return view('student.dashboard');
    }

    public function courses() {
        $student = auth()->user();
        $courses = $student->courses; // eager load
        return view('student.courses',compact('courses'));
    }

    public function assignments() {
        $student = auth()->user();
        $assignments = [];
    
        foreach ($student->courses as $course) {
            foreach ($course->assignments as $assignment) {
                $assignments[] = $assignment;
            }
        }
        return view('student.assignments',compact('assignments'));

    }

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
    
    
     public function notifications() {
        return view('student.notifications');
    }

    public function profile() {
        return view('student.profile');
    }
}
