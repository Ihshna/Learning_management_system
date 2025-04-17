<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddAdminController extends Controller
{
    public function create()
    {
        return view('superadmin.admins.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Store admin in users table with role 'admin'
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin added successfully!');
    }

    public function index()
{
    $admins = User::where('role', 'admin')->get();
    return view('superadmin.admins.manage', compact('admins'));
}

public function edit($id)
{
    $admin = User::findOrFail($id);
    return view('superadmin.admins.edit', compact('admin'));
}

public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $admin->id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;

    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect()->route('superadmin.admins.manage')->with('success', 'Admin updated successfully!');
}

public function destroy($id)
{
    $admin = User::findOrFail($id);
    $admin->delete();

    return redirect()->route('superadmin.admins.manage')->with('success', 'Admin deleted successfully!');
}
}