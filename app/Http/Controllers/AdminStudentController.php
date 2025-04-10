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
        ]);

        Student::create([
            'user_id' => $user->id,
            'enrollment_no' => $request->enrollment_no,
            'enrollment_date' => $request->enrollment_date
        ]);

        session()->flash('success','Student added successfully');

        return redirect()->route('admin.students.add');
    } 
}
