<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LectureNote;
use App\Models\Course;


class AdminLectureNoteController extends Controller
{
    public function create()
    {
        $courses = Course::where('status', 'approved')->get();
        return view('admin.lecturenotes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecture_number' => 'required|string',
            'title' => 'required|string',
            'file' => 'required|mimes:pdf|max:10000'
        ]);

        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('notes'), $fileName);

        LectureNote::create([
            'course_id' => $request->course_id,
            'lecture_number' => $request->lecture_number,
            'title' => $request->title,
            'file_path' => 'notes/' . $fileName,
        ]);

        return back()->with('success', 'Lecture note uploaded successfully!');
    }

}
