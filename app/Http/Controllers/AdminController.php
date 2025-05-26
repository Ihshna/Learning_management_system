<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\CourseRequest;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //Fetch payment details
    public function viewPayments() {
        $payments = Payment::with('student', 'course')->get();
        return view('admin.payments', compact('payments'));
    }
    
    //Approve payment
    public function approvePayment($id) {
        $payment = Payment::findOrFail($id);

        // Update payment table
        $payment->update(['status' => 'approved']);

        // Update course_student table
        DB::table('course_student')
        ->where('student_id', $payment->student_id)
        ->where('course_id', $payment->course_id)
        ->update(['status' => 'approved', 'updated_at' => now()]);

    return redirect()->back()->with('success', 'Payment approved and student enrolled.');
    }

    //Reject payment
    public function rejectPayment($id) {
     $payment = Payment::findOrFail($id);

    // Update payment table
    $payment->update(['status' => 'rejected']);

    // Update course_student table
    DB::table('course_student')
        ->where('student_id', $payment->student_id)
        ->where('course_id', $payment->course_id)
        ->update(['status' => 'rejected', 'updated_at' => now()]);

    return redirect()->back()->with('error', 'Payment rejected.');
    }
    
    //View courses details with status pending
    public function viewCourseRequests()
    {
       $requests = CourseRequest::where('status', 'pending')->with(['student', 'course'])->get();
       return view('admin.course_requests.index', compact('requests'));
    }
    
    //Approve courses
    public function approveCourseRequest($id)
    {
       $request = CourseRequest::findOrFail($id);
       $request->status = 'approved';
       $request->save();

        return redirect()->back()->with('success', 'Course request approved.');
    }
    
    //Rejecting course
    public function rejectCourseRequest($id)
    {
        $request = CourseRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

    return redirect()->back()->with('error', 'Course request rejected.');
    }

}
