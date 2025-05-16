<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.dashboard');
    }

    public function paymentForm($id)
{
    $course = Course::findOrFail($id);
    return view('student.payment_form', compact('course'));
}

public function submitPayment(Request $request, $id)
{
    $request->validate([
        'payment_slip' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $file = $request->file('payment_slip');
    $filePath = $file->store('payment_slips', 'public');

    Payment::create([
        'student_id' => auth()->id(),
        'course_id' => $id,
        'payment_slip' => $filePath,
        'status' => 'pending',
    ]);

    return redirect()->route('student.dashboard')->with('success', 'Payment submitted for approval.');
}
}
