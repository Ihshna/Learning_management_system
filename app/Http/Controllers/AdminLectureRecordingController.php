<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LectureRecording;
use App\Models\Course;

class AdminLectureRecordingController extends Controller
{
    public function index()
    {
        $recordings = LectureRecording::latest()->get();
        return view('admin.lecture_recordings.index', compact('recordings'));
    }

    public function create()
    {
        $courses = Course::where('status','approved')->get();
        return view('admin.lecture_recordings.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file_path' => 'required|url', // YouTube link
            'course_id' => 'nullable|exists:courses,id',
        ]);

        LectureRecording::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $request->file_path,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('admin.lecture_recordings.index')->with('success', 'Lecture Recording added successfully!');
    }

    public function destroy($id)
{
    $recording = LectureRecording::findOrFail($id);

    // Delete the recording
    $recording->delete();

    return redirect()->back()->with('success', 'Lecture recording deleted successfully.');
}
}