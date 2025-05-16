<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\CourseRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function viewPayments() {
    $payments = Payment::with('student', 'course')->get();
    return view('admin.payments', compact('payments'));
}

public function approvePayment($id) {
    $payment = Payment::findOrFail($id);
    $payment->status = 'approved';
    $payment->save();

    // Optional: enroll the student into course
    $payment->student->enrolledCourses()->attach($payment->course_id);

    return back()->with('success', 'Payment approved and student enrolled.');
}

public function rejectPayment($id) {
    $payment = Payment::findOrFail($id);
    $payment->status = 'rejected';
    $payment->save();

    return back()->with('error', 'Payment rejected.');
}

public function viewCourseRequests()
{
    $requests = CourseRequest::where('status', 'pending')->with(['student', 'course'])->get();
    return view('admin.course_requests.index', compact('requests'));
}
public function approveCourseRequest($id)
{
    $request = CourseRequest::findOrFail($id);
    $request->status = 'approved';
    $request->save();

    return redirect()->back()->with('success', 'Course request approved.');
}

public function rejectCourseRequest($id)
{
    $request = CourseRequest::findOrFail($id);
    $request->status = 'rejected';
    $request->save();

    return redirect()->back()->with('error', 'Course request rejected.');
}

}
