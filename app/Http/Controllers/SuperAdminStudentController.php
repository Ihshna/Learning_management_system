<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class SuperAdminStudentController extends Controller
{
    public function pending()
    {
        $users = User::where('role','student')->where('status', 'pending')->get();
        return view('superadmin.Student.pending', compact('users'));
    }
    public function approve($id)
    {
        $users = User::where('role','student')->findOrFail($id);
        $users->status = 'approved';
        $users->save();
    
        return redirect()->back()->with('success', 'student approved successfully.');
    }
    public function reject($id)
    {
        $users = User::where('role','student')->findOrFail($id);
        $users->status = 'rejected';
        $users->save();
    
        return redirect()->back()->with('success', 'student rejected successfully.');
    }
    public function approved()
    {
        $users = User::where('role','student')->where('status', 'approved')->get();
        return view('superadmin.Student.approved', compact('users'));
    }
}
