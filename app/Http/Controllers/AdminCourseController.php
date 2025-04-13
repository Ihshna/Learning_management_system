<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:courses,code',
            'description' => 'required',
        ]);

        Course::create([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description,
            'status' => 'pending',
            'created_by'=> auth()->user()->id,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course submitted for approval!');
    }

    public function manage(){
        $courses= Course::where('created_by',Auth::id())->get();

        return view('admin.courses.manage',compact('courses'));
    }

    public function edit($id)
{
    $course = Course::findOrFail($id);
    return view('admin.courses.edit', compact('course'));
}

public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);
    
    $request->validate([
        'title' => 'required|string',
        'code' => 'required|string',
        'description' => 'required|string',
    ]);

    $course->update([
        'title' => $request->title,
        'code' => $request->code,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.courses.manage')->with('success', 'Course updated successfully.');
}

public function delete($id)
{
    $course = Course::findOrFail($id);
    if ($course->status == 'pending') {
        $course->delete();
        return redirect()->route('admin.courses.manage')->with('success', 'Course deleted successfully.');
    }

    return redirect()->route('admin.courses.manage')->with('error', 'You can only delete pending courses.');
}
}
