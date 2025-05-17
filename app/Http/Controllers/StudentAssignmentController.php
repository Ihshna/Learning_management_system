<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;

class StudentAssignmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = $user->enrolledCourses()->pluck('course_id'); // Get course IDs from pivot
    
        // Load assignments from those courses + check if already submitted
        $assignments = Assignment::whereIn('course_id', $courses)
            ->with(['submissions' => function($query) use ($user) {
                $query->where('student_id', $user->id); 
            }])
            ->latest()
            ->get();
    
        foreach ($assignments as $assignment) {
            $assignment->is_submitted = $assignment->submissions->isNotEmpty();
        }
    
        return view('student.assignments.index', compact('assignments'));
    
    }

    public function submit($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('student.assignments.submit', compact('assignment'));
    }

    public function storeSubmission(Request $request, $id)
    {
        $request->validate([
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
        'note' => 'nullable|string',
    ]);

    $user = auth()->user();
    $assignment = Assignment::findOrFail($id);

    if ($request->hasFile('file')) {
        // Define custom path inside public/assignments
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assignments'), $filename);

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id' => auth()->id(),
            'file_path' => 'assignments/' . $filename, // Save relative path
            'note' => $request->note,
        ]);

        return redirect()->route('student.assignments')->with('success', 'Assignment submitted successfully!');
    }

    return redirect()->back()->with('error', 'Failed to upload assignment.');
    }

    public function submittedAssignments()
    {
        $user = auth()->user();

        if ($user) {
            $submissions = AssignmentSubmission::where('student_id', $user->id)
                ->with('assignment')
                ->latest()
                ->get();
        } else {
            $submissions = collect();
        }

        return view('student.assignments.submitted', compact('submissions'));
    }
}
