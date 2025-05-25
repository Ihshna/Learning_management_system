<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use Illuminate\Http\Request;
use App\Models\Course;

class LiveClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $liveClasses = LiveClass::latest()->paginate(10); // 10 per page (you can change this)
        return view('admin.liveclasses.index', compact('liveClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.liveclasses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meeting_link' => 'required|url',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        // Explicit assignment for clarity and security
        LiveClass::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'meeting_link' => $validated['meeting_link'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'] ?? null,
            'course_id' => $validated['course_id'] ?? null,
        ]);

        return redirect()->route('admin.liveclasses.index')->with('success', 'Live class added successfully.');
    }

    public function edit($id)
{
    $liveClass = LiveClass::findOrFail($id);
    $courses = Course::all(); // To show course list in dropdown
    return view('admin.liveclasses.edit', compact('liveClass', 'courses'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'meeting_link' => 'required|url',
        'start_time' => 'required|date',
        'end_time' => 'nullable|date|after_or_equal:start_time',
        'course_id' => 'nullable|exists:courses,id',
    ]);

    $liveClass = LiveClass::findOrFail($id);
    $liveClass->update($request->all());

    return redirect()->route('admin.liveclasses.index')->with('success', 'Live class updated successfully.');
}
public function destroy($id)
{
    $liveClass = LiveClass::findOrFail($id);
    $liveClass->delete();

    return redirect()->route('admin.liveclasses.index')->with('success', 'Live class deleted successfully.');
}


}
