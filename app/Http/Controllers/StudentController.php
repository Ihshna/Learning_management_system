<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
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

    $course = Course::findOrFail($id);
    $file = $request->file('payment_slip');

    $filename = 'slip_' . time() . '_' . auth()->id() . '.' . $file->getClientOriginalExtension();

    // Save file in public/payment_slips
    $destinationPath = public_path('payment_slips');
    $file->move($destinationPath, $filename);

    $filePath = 'payment_slips/' . $filename;

    Payment::create([
        'student_id' => auth()->id(),
        'course_id' => $id,
        'payment_slip' => $filePath, 
        'status' => 'pending',
    ]);

    return redirect()->route('student.course.payment.form', $id)
                     ->with('success', 'Payment submitted successfully. Awaiting admin approval.');
}


}