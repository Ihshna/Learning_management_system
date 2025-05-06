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
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $courses = $student->courses->pluck('id');

            // Updated part: load assignments + submissions for the logged-in student
            $assignments = Assignment::whereIn('course_id', $courses)
                ->with(['submissions' => function($query) use ($student) {
                    $query->where('student_id', $student->id);
                }])
                ->latest()
                ->get();

            // Mark assignments as submitted or not
            foreach ($assignments as $assignment) {
                $assignment->is_submitted = $assignment->submissions->isNotEmpty();
            }

        } else {
            $assignments = collect();
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

        $student = Student::where('user_id', auth()->id())->first();
        $assignment = Assignment::findOrFail($id);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');

            AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
                'file_path' => $filePath,
                'note' => $request->note,
            ]);

            return redirect()->route('student.assignments')->with('success', 'Assignment submitted successfully!');
        }

        return redirect()->back()->with('error', 'Failed to upload assignment.');
    }

    public function submittedAssignments()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if ($student) {
            $submissions = AssignmentSubmission::where('student_id', $student->id)
                ->with('assignment')
                ->latest()
                ->get();
        } else {
            $submissions = collect();
        }

        return view('student.assignments.submitted', compact('submissions'));
    }
}
