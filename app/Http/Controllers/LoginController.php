<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Get the user first
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    
        // Prepare credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        // Add status to credentials if student
        if ($user->role === 'student') {
            $credentials['status'] = 'approved';
        }
    
        // Try to login
        if (Auth::attempt($credentials)) {
            if ($user->role === 'super_admin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            }
        }
    
        return back()->withErrors(['email' => 'Invalid credentials or account not approved.']);
    }
    

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}