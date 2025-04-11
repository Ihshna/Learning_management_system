<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminManagementController extends Controller
{
    public function create()
{
    return view('superadmin.add_admin');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'admin',
    ]);

    return redirect()->back()->with('success', 'Admin added successfully.');
}
public function index()
{
    $admins = User::where('role', 'admin')->get();
    return view('superadmin.manage_admins', compact('admins'));
}

public function edit($id)
{
    $admin = User::findOrFail($id);
    return view('superadmin.edit_admin', compact('admin'));
}

public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $admin->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect('/superadmin/admins')->with('success', 'Admin updated successfully!');
}

public function destroy($id)
{
    User::where('id', $id)->delete();
    return redirect()->back()->with('success', 'Admin deleted successfully!');
}




    //
}
