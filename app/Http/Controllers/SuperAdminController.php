<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class SuperAdminController extends Controller
{

    public function pendingRequests()
{
    $courses = Course::where('status', 'pending')->get();
    return view('superadmin.courses.pending', compact('courses'));
}

public function approvedCourses()
{
    $courses = Course::where('status', 'approved')->get();
    return view('superadmin.courses.approved', compact('courses'));
}

public function rejectedCourses()
{
    $courses = Course::where('status', 'rejected')->get();
    return view('superadmin.courses.rejected', compact('courses'));
}

    public function manageAdmins()
    {
        $admins = User::where('role', 'admin')->get(); // make sure it's getting from users
        return view('superadmin.manage_admins', compact('admins'));
    }
    
    public function deleteAdmin($id) {
        Admin::destroy($id);
        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }

    public function index()
    {
        return view('superadmin.dashboard');
    }
    public function addAdminForm()
    {
        return view('superadmin.add_admin');
    }
    public function showAddAdmin() {
        return view('superadmin.add_admin'); // This should point to resources/views/superadmin/add_admin.blade.php
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('superadmin.manageAdmins')->with('success', 'Admin added successfully!');
    }

    /*
    public function dashboard()
{
    $adminCount = User::where('role', 'admin')->count();

    $pendingCourses = Course::where('status', 'pending')->count();
    $approvedCourses = Course::where('status', 'approved')->count();
    $rejectedCourses = Course::where('status', 'rejected')->count();

    return view('superadmin.dashboard', compact(
        'adminCount',
        'pendingCourses',
        'approvedCourses',
        'rejectedCourses'
    ));
}
*/

}