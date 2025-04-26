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
            $assignments = Assignment::whereIn('course_id', $courses)->latest()->get();
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
        $submissions = \App\Models\AssignmentSubmission::where('student_id', $student->id)
                        ->with('assignment')
                        ->latest()
                        ->get();
    } else {
        $submissions = collect();
    }

    return view('student.assignments.submitted', compact('submissions'));
}

}

