<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssignmentController extends Controller
{
public function create() {
    $courses = Course::all();
    return view('admin.assignments.create', compact('courses'));
}

public function store(Request $request) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'course_id' => 'required',
        'due_date' => 'required|date',
    ]);

    Assignment::create($request->all());
    return redirect()->route('admin.assignments.manage')->with('success', 'Assignment Created Successfully');
}

public function index() {
    $assignments = Assignment::with('course')->get();
    return view('admin.assignments.manage', compact('assignments'));
}

public function edit($id) {
    $assignment = Assignment::findOrFail($id);
    $courses = Course::all();
    return view('admin.assignments.edit', compact('assignment', 'courses'));
}

public function update(Request $request, $id) {
    $assignment = Assignment::findOrFail($id);
    $assignment->update($request->all());
    return redirect()->route('admin.assignments.manage')->with('success', 'Assignment Updated Successfully');
}

public function delete($id) {
    Assignment::findOrFail($id)->delete();
    return back()->with('success', 'Assignment Deleted Successfully');
}
}