<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    public function create()
    {
        return view('admin.students.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'enrollment_no' => 'required|unique:students',
            'enrollment_date' => 'required|date'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => Hash::make($request->password),
            'status'=>'pending',
        ]);

        Student::create([
            'user_id' => $user->id,
            'enrollment_no' => $request->enrollment_no,
            'enrollment_date' => $request->enrollment_date,
            'created_by'=> auth()->user()->id,
        ]);

        session()->flash('success','Student added successfully');

        return redirect()->route('admin.students.add');
    } 

    public function index()
{
    $students = Student::with('user')->get();
    return view('admin.students.manage', compact('students'));
}

public function edit($id)
{
    $student = Student::with('user')->findOrFail($id);
    return view('admin.students.edit', compact('student'));
}

public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $user = $student->user;

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'enrollment_no' => 'required|unique:students,enrollment_no,' . $student->id,
        'enrollment_date' => 'required|date',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $student->update([
        'enrollment_no' => $request->enrollment_no,
        'enrollment_date' => $request->enrollment_date,
    ]);

    return redirect()->route('admin.students.manage')->with('success', 'Student updated.');
}

public function delete($id)
{
    $student = Student::findOrFail($id);
    $student->user()->delete(); // Also deletes student due to cascade
    return redirect()->route('admin.students.manage')->with('success', 'Student deleted.');
}
}
